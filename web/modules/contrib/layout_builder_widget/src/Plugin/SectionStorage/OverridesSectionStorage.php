<?php

namespace Drupal\layout_builder_widget\Plugin\SectionStorage;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityFieldManagerInterface;
use Drupal\Core\Entity\EntityRepositoryInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Plugin\Context\Context;
use Drupal\Core\Plugin\Context\ContextDefinition;
use Drupal\Core\Plugin\Context\EntityContext;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\TempStore\SharedTempStoreFactory;
use Drupal\Core\Url;
use Drupal\layout_builder\Context\LayoutBuilderContextTrait;
use Drupal\layout_builder\Entity\LayoutBuilderEntityViewDisplay;
use Drupal\layout_builder\Plugin\SectionStorage\OverridesSectionStorage as CoreOverridesSectionStorage;
use Drupal\layout_builder\SectionStorage\SectionStorageManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Overrides the 'overrides' section storage type.
 */
class OverridesSectionStorage extends CoreOverridesSectionStorage {

  use LayoutBuilderContextTrait;

  /**
   * Stores the shared tempstore.
   *
   * @var \Drupal\Core\TempStore\SharedTempStore
   */
  protected $tempStore;

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityTypeManagerInterface $entity_type_manager, EntityFieldManagerInterface $entity_field_manager, SectionStorageManagerInterface $section_storage_manager, EntityRepositoryInterface $entity_repository, AccountInterface $current_user, SharedTempStoreFactory $temp_store_factory) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $entity_type_manager, $entity_field_manager, $section_storage_manager, $entity_repository, $current_user);
    $this->tempStore = $temp_store_factory->get('layout_builder.section_storage.overrides');
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity_type.manager'),
      $container->get('entity_field.manager'),
      $container->get('plugin.manager.layout_builder.section_storage'),
      $container->get('entity.repository'),
      $container->get('current_user'),
      $container->get('tempstore.shared')
    );
  }

  /**
   * The storage id.
   *
   * @var string
   */
  protected $storageId;

  /**
   * Sets a new storage id.
   *
   * @param string $id
   *   Unique identifier for storage.
   */
  public function setStorageId(string $id) {
    $this->storageId = $id;
  }

  /**
   * {@inheritdoc}
   */
  public function getStorageId() {
    $entity = $this->getEntity();

    if ($entity->isNew()) {
      return $this->storageId ?: ($entity->getEntityTypeId() . '.' . $entity->uuid());
    }
    return $entity->getEntityTypeId() . '.' . $entity->id();
  }

  /**
   * {@inheritdoc}
   */
  public function getTempstoreKey() {
    $entity = $this->getEntity();

    if ($entity->isNew()) {
      return $this->getStorageId();
    }
    return parent::getTempstoreKey();
  }

  /**
   * {@inheritdoc}
   */
  public function getLayoutBuilderUrl($rel = 'view') {
    $entity = $this->getEntity();
    if ($entity->isNew()) {
      $route_parameters[$entity->getEntityTypeId()] = $entity->uuid();
      return Url::fromRoute("layout_builder.{$this->getStorageType()}.{$this->getEntity()->getEntityTypeId()}.$rel", $route_parameters);
    }

    return parent::getLayoutBuilderUrl($rel);
  }

  /**
   * {@inheritdoc}
   */
  public function deriveContextsFromRoute($value, $definition, $name, array $defaults) {
    $contexts = parent::deriveContextsFromRoute($value, $definition, $name, $defaults);

    if (!$contexts && strpos($value, '.') !== FALSE) {
      [$entity_type_id, $entity_id] = explode('.', $value, 2);

      /** @var \Drupal\layout_builder\SectionStorageInterface $section_storage */
      $section_storage = $this->getSectionStorageFromTempStore($entity_type_id, $entity_id);
      if ($section_storage && $entity = $section_storage->getEntity()) {
        $contexts['entity'] = EntityContext::fromEntity($entity);
        $view_mode = 'full';
        // Retrieve the actual view mode from the returned view display as the
        // requested view mode may not exist and a fallback will be used.
        $view_mode = LayoutBuilderEntityViewDisplay::collectRenderDisplay($entity, $view_mode)
          ->getMode();
        $contexts['view_mode'] = new Context(new ContextDefinition('string'), $view_mode);
      }
    }

    return $contexts;
  }

  /**
   * {@inheritdoc}
   */
  protected function handleTranslationAccess(AccessResult $result, $operation, AccountInterface $account) {
    return $result;
  }

  /**
   * Gets the section storage from tempstore.
   *
   * @param string $entity_type_id
   *   The entity type id.
   * @param string $entity_id
   *   Unique identifier of entity.
   *
   * @return \Drupal\layout_builder\SectionStorageInterface|null
   *   The section storage loaded from tempstore.
   */
  protected function getSectionStorageFromTempStore(string $entity_type_id, string $entity_id) {
    $tempstore = $this->tempStore->get($entity_type_id . '.' . $entity_id);
    return !empty($tempstore['section_storage']) ? $tempstore['section_storage'] : NULL;
  }

}
