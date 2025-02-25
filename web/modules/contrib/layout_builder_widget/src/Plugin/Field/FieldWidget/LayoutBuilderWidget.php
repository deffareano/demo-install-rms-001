<?php

namespace Drupal\layout_builder_widget\Plugin\Field\FieldWidget;

use Drupal\Component\Utility\Html;
use Drupal\Component\Utility\NestedArray;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\Context\EntityContext;
use Drupal\Core\Render\RendererInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\layout_builder\LayoutTempstoreRepositoryInterface;
use Drupal\layout_builder\Plugin\SectionStorage\OverridesSectionStorage;
use Drupal\layout_builder\SectionStorage\SectionStorageManagerInterface;
use Drupal\layout_builder\SectionStorageInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * A widget to display the layout form on entity edit form.
 *
 * @FieldWidget(
 *   id = "layout_builder_widget",
 *   label = @Translation("Layout Builder Widget"),
 *   description = @Translation("A field widget for Layout Builder."),
 *   field_types = {
 *     "layout_section",
 *   },
 *   multiple_values = TRUE,
 * )
 */
class LayoutBuilderWidget extends WidgetBase {

  /**
   * The section storage manager.
   *
   * @var \Drupal\layout_builder\SectionStorage\SectionStorageManagerInterface
   */
  protected $sectionStorageManager;

  /**
   * The layout tempstore repository.
   *
   * @var \Drupal\layout_builder\LayoutTempstoreRepositoryInterface
   */
  protected $layoutTempstoreRepository;

  /**
   * The renderer.
   *
   * @var \Drupal\Core\Render\RendererInterface
   */
  protected $renderer;

  /**
   * The current user.
   *
   * @var \Drupal\Core\Session\AccountInterface
   */
  protected $currentUser;

  /**
   * {@inheritdoc}
   */
  public function __construct($plugin_id, $plugin_definition, FieldDefinitionInterface $field_definition, array $settings, array $third_party_settings, SectionStorageManagerInterface $section_storage_manager, LayoutTempstoreRepositoryInterface $layout_tempstore_repository, RendererInterface $renderer, AccountInterface $current_user) {
    parent::__construct($plugin_id, $plugin_definition, $field_definition, $settings, $third_party_settings);
    $this->sectionStorageManager = $section_storage_manager;
    $this->layoutTempstoreRepository = $layout_tempstore_repository;
    $this->renderer = $renderer;
    $this->currentUser = $current_user;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $plugin_id,
      $plugin_definition,
      $configuration['field_definition'],
      $configuration['settings'],
      $configuration['third_party_settings'],
      $container->get('plugin.manager.layout_builder.section_storage'),
      $container->get('layout_builder.tempstore_repository'),
      $container->get('renderer'),
      $container->get('current_user'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      'discard_changes' => TRUE,
      'revert_overrides' => TRUE,
      'toggle_content_preview' => TRUE,
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $element = [];

    $element['discard_changes'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Show discard changes action button'),
      '#default_value' => $this->getSetting('discard_changes'),
    ];

    $element['revert_overrides'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Show revert overrides action button'),
      '#default_value' => $this->getSetting('revert_overrides'),
    ];

    $element['toggle_content_preview'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Show toggle content preview'),
      '#default_value' => $this->getSetting('toggle_content_preview'),
    ];

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    $summary['discard_changes'] = $this->t('Discard changes: @status', [
      '@status' => $this->getSetting('discard_changes') ? $this->t('Shown') : $this->t('Hidden'),
    ]);

    $summary['revert_overrides'] = $this->t('Revert overrides: @status', [
      '@status' => $this->getSetting('revert_overrides') ? $this->t('Shown') : $this->t('Hidden'),
    ]);

    $summary['toggle_content_preview'] = $this->t('Toggle content preview: @status', [
      '@status' => $this->getSetting('toggle_content_preview') ? $this->t('Shown') : $this->t('Hidden'),
    ]);

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $entity = $items->getEntity();

    $field_name = $items->getFieldDefinition()->getName();

    $user_input = $form_state->getUserInput();
    $storage_id = $user_input[$field_name]['storage_id'] ?? '';

    // Reset storage ID if ajax was triggered.
    if ($form_state->getTriggeringElement()) {
      $storage_id = '';
    }

    $section_storage = $this->buildSectionStorage($entity, $storage_id);

    $wrapper_id = Html::getUniqueId($field_name . '-ajax-wrapper');

    $element += [
      '#tree' => TRUE,
      '#prefix' => '<hr class="layout-builder-widget-divider"><div id="' . $wrapper_id . '" class="layout-builder-widget">',
      '#suffix' => '</div>',
    ];

    $element += $this->buildActions($wrapper_id);

    $element['layout_builder'] = [
      '#type' => 'layout_builder',
      '#section_storage' => $section_storage,
    ];

    // A unique identifier (UUID) is generated for the entity each time the
    // page is refreshed or a new entity is submitted.
    // This UUID is stored in a hidden form element to prevent
    // its loss during further processing.
    $element['storage_id'] = [
      '#type' => 'hidden',
      '#value' => $section_storage->getStorageId(),
    ];

    $element['#attached']['library'][] = 'layout_builder_widget/layout_builder_widget.styles';

    return $element;
  }

  /**
   * Builds the actions container.
   *
   * @param string $wrapper_id
   *   The unique identifier of the widget wrapper.
   *
   * @return array
   *   An array with the actions container element and its children.
   */
  protected function buildActions(string $wrapper_id): array {
    $actions['discard_changes'] = [
      '#type' => 'submit',
      '#name' => 'discard_changes',
      '#value' => $this->t('Discard changes'),
      '#limit_validation_errors' => [],
      '#access' => (bool) $this->getSetting('discard_changes'),
      '#submit' => [[$this, 'actionsSubmit']],
      '#ajax' => [
        'callback' => [$this, 'ajaxRefresh'],
        'wrapper' => $wrapper_id,
      ],
    ];

    $actions['revert_overrides'] = [
      '#type' => 'submit',
      '#name' => 'revert_overrides',
      '#limit_validation_errors' => [],
      '#access' => (bool) $this->getSetting('revert_overrides'),
      '#value' => $this->t('Revert to defaults'),
      '#submit' => [[$this, 'actionsSubmit']],
      '#ajax' => [
        'callback' => [$this, 'ajaxRefresh'],
        'wrapper' => $wrapper_id,
      ],
    ];

    $actions['toggle_content_preview'] = [
      '#type' => 'checkbox',
      '#name' => 'toggle_content_preview',
      '#title' => $this->t('Show content preview'),
      '#access' => (bool) $this->getSetting('toggle_content_preview'),
      '#limit_validation_errors' => [],
      '#value' => TRUE,
      '#attributes' => [
        // Set attribute used by local storage to get content preview status.
        'data-content-preview-id' => "Drupal.layout_builder.content_preview.{$this->currentUser->id()}",
      ],
      '#id' => 'layout-builder-content-preview',
    ];

    return ['actions' => $actions];
  }

  /**
   * Submit callback for actions.
   *
   * @throws \Drupal\Component\Plugin\Exception\ContextException
   */
  public function actionsSubmit(array $form, FormStateInterface $form_state) {
    $build_info = $form_state->getBuildInfo();
    $triggering_element = $form_state->getTriggeringElement();

    $section_storage = NULL;
    /** @var \Drupal\Core\Entity\ContentEntityInterface $entity */
    $entity = $build_info['callback_object']->getEntity();
    if ($entity) {
      $user_input = $form_state->getUserInput();
      $storage_id = $user_input[OverridesSectionStorage::FIELD_NAME]['storage_id'] ?? '';
      $section_storage = $this->buildSectionStorage($entity, $storage_id);
    }
    $name = $triggering_element['#name'];
    switch ($name) {
      case 'discard_changes':
        if ($section_storage) {
          $this->layoutTempstoreRepository->delete($section_storage);
        }
        break;

      case 'revert_overrides':
        if ($section_storage) {
          $section_storage->removeAllSections();
          foreach ($section_storage->getDefaultSectionStorage()
            ->getSections() as $section) {
            $section_storage->appendSection($section);
          }
          // Save storage to tempstore.
          $this->layoutTempstoreRepository->set($section_storage);
        }
        break;
    }

    $form_state->setRebuild();
  }

  /**
   * Ajax refresh callback.
   */
  public function ajaxRefresh(array $form, FormStateInterface $form_state) {
    $parents = $form_state->getTriggeringElement()['#array_parents'];
    return NestedArray::getValue($form, array_slice($parents, 0, 2));
  }

  /**
   * Build section storage, extracting storage from entity & tempstore.
   *
   * @param \Drupal\Core\Entity\EntityInterface $entity
   *   The entity to check.
   * @param string $storage_id
   *   (optional) Unique identifier for storage.
   *
   * @return \Drupal\layout_builder\SectionStorageInterface|null
   *   The section storage loaded from the entity or tempstore otherwise null.
   *
   * @throws \Drupal\Component\Plugin\Exception\ContextException
   */
  public function buildSectionStorage(EntityInterface $entity, string $storage_id = '') {
    $section_storage = $this->getSectionStorageFromEntity($entity);

    // Check if storage exist in tempstore.
    if ($section_storage) {
      return $this->getSectionStorageFromTempStore($section_storage, $storage_id);
    }

    return $section_storage;
  }

  /**
   * Gets the section storage from entity.
   *
   * @param \Drupal\Core\Entity\EntityInterface $entity
   *   The entity to check.
   *
   * @return \Drupal\layout_builder\SectionStorageInterface|null
   *   The section storage loaded from entity.
   */
  protected function getSectionStorageFromEntity(EntityInterface $entity) {
    return $this->sectionStorageManager->load('overrides', ['entity' => EntityContext::fromEntity($entity)]);
  }

  /**
   * Gets the section storage from tempstore.
   *
   * @param \Drupal\layout_builder\SectionStorageInterface $section_storage
   *   The entity to check.
   * @param string $storage_id
   *   (optional) Unique identifier for storage.
   *
   * @return \Drupal\layout_builder\SectionStorageInterface|null
   *   The section storage loaded from tempstore.
   *
   * @throws \Drupal\Component\Plugin\Exception\ContextException
   */
  protected function getSectionStorageFromTempStore(SectionStorageInterface $section_storage, string $storage_id = '') {
    $entity = $section_storage->getContextValue('entity');

    if ($storage_id && $entity->isNew()) {
      $this->setStorageId($section_storage, $storage_id);
    }

    if ($this->layoutTempstoreRepository->has($section_storage)) {
      $section_storage = $this->layoutTempstoreRepository->get($section_storage);
    }

    return $section_storage;
  }

  /**
   * Set storage id in section storage.
   *
   * @param \Drupal\layout_builder\SectionStorageInterface $section_storage
   *   The entity to check.
   * @param string $storage_id
   *   Unique identifier for storage.
   */
  public function setStorageId(SectionStorageInterface $section_storage, string $storage_id) {
    $section_storage->setStorageId($storage_id);
  }

  /**
   * {@inheritdoc}
   */
  public function extractFormValues(FieldItemListInterface $items, array $form, FormStateInterface $form_state) {
    if (!$form_state->isValidationComplete()) {
      return;
    }

    $entity = $items->getEntity();
    $field_name = $this->fieldDefinition->getName();

    $path = array_merge($form['#parents'], [$field_name, 'storage_id']);
    $key_exists = NULL;

    /** @var \Drupal\layout_builder\OverridesSectionStorageInterface $section_storage */
    $storage_id = NestedArray::getValue($form_state->getValues(), $path, $key_exists);
    if ($key_exists) {
      $section_storage = $this->getSectionStorageFromEntity($entity);
      if ($section_storage) {
        $section_storage = $this->getSectionStorageFromTempStore($section_storage, $storage_id);

        $items->setValue($section_storage->getSections());
        // Deleting section storage from tempstore.
        $this->layoutTempstoreRepository->delete($section_storage);

        $this->messenger()
          ->addStatus($this->t('The layout override has been saved.'));
      }
    }
  }

}
