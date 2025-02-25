<?php

namespace Drupal\Tests\layout_builder_widget\FunctionalJavascript;

use Drupal\FunctionalJavascriptTests\WebDriverTestBase;
use Drupal\language\Entity\ConfigurableLanguage;

/**
 * Base class for Layout Builder Widget.
 */
abstract class LayoutBuilderWidgetBase extends WebDriverTestBase {

  /**
   * {@inheritdoc}
   */
  protected static $modules = [
    'node',
    'layout_builder',
    'layout_builder_widget',
    'field_ui',
    'content_translation',
    'contextual',
    'block',
    'block_content',
  ];

  /**
   * The name of the test node type to create.
   *
   * @var \Drupal\node\Entity\NodeType
   */
  protected $contentType;

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'stark';

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();
    // Login as a root.
    $this->drupalLogin($this->rootUser);

    // Set up an additional language.
    ConfigurableLanguage::createFromLangcode('es')->save();

    $type_name = mb_strtolower($this->randomMachineName());

    $this->contentType = $this->createContentType([
      'name' => $type_name,
      'type' => $type_name,
    ]);

    $this->enableOverrides();
    $this->enableContentTranslation();
    $this->enableLayoutBuilderFieldOnFormDisplay();
  }

  /**
   * Enable content translation.
   */
  protected function enableContentTranslation(): void {
    $this->drupalGet('admin/config/regional/content-language');
    $edit = [
      'entity_types[node]' => TRUE,
      "settings[node][{$this->contentType->id()}][translatable]" => TRUE,
    ];

    $this->submitForm($edit, 'Save configuration');
  }

  /**
   * Enable Layout Builder field on form display.
   */
  protected function enableLayoutBuilderFieldOnFormDisplay(): void {
    $session = $this->getSession();
    $assert_session = $this->assertSession();
    $page = $session->getPage();

    $this->drupalGet("admin/structure/types/manage/{$this->contentType->id()}/form-display");

    // Toggle row weight selects as visible.
    $page->pressButton('Show row weights');

    // Move the test field to the content region.
    $this->assertSession()->waitForElementVisible('css', '[name="fields[layout_builder__layout][region]"]');
    $page->selectFieldOption('fields[layout_builder__layout][region]', 'content');

    $assert_session->assertWaitOnAjaxRequest();

    $this->submitForm([], 'Save');
  }

  /**
   * Enable overrides functionality of Layout Builder.
   */
  public function enableOverrides(): void {
    $this->drupalGet("admin/structure/types/manage/{$this->contentType->id()}/display/default");
    $edit = [
      'layout[enabled]' => TRUE,
      'layout[allow_custom]' => TRUE,
    ];

    $this->submitForm($edit, 'Save');
  }

}
