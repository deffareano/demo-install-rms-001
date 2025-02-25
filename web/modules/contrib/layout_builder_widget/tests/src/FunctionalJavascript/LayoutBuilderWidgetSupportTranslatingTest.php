<?php

namespace Drupal\Tests\layout_builder_widget\FunctionalJavascript;

/**
 * Test enabling layout builder field translation.
 *
 * @group layout_builder_widget
 */
class LayoutBuilderWidgetSupportTranslatingTest extends LayoutBuilderWidgetBase {

  /**
   * Tests layout builder translation is enabled & message warning not shown.
   *
   * @throws \Behat\Mink\Exception\ResponseTextException
   */
  public function testLayoutBuilderFieldTranslationEnable(): void {
    $assert_session = $this->assertSession();

    $this->drupalGet('admin/config/regional/content-language');

    $edit = [
      "settings[node][{$this->contentType->id()}][fields][layout_builder__layout]" => TRUE,
    ];

    $this->submitForm($edit, 'Save configuration');

    $assert_session->pageTextNotContains('Layout Builder does not support translating layouts.');
  }

  /**
   * Tests if layout builder widget can be translated.
   *
   * @throws \Behat\Mink\Exception\ResponseTextException
   * @throws \Behat\Mink\Exception\ExpectationException
   */
  public function testLayoutBuilderWidgetTranslation(): void {
    $node = $this->createNode([
      'type' => $this->contentType->id(),
      'title' => 'Layout Builder Widget transition',
      'body' => [
        [
          'value' => 'Test body',
        ],
      ],
    ]);

    $session = $this->getSession();
    $page = $session->getPage();
    $assert_session = $this->assertSession();

    $this->drupalGet("node/{$node->id()}/edit");
    // Add a new block.
    $this->clickLink('Add block');
    $assert_session->assertWaitOnAjaxRequest();

    $this->clickLink('Powered by Drupal');
    $assert_session->assertWaitOnAjaxRequest();

    $page->pressButton('Add block');
    $assert_session->assertWaitOnAjaxRequest();

    $page->pressButton('Save');

    // Check that added block exists on node view.
    $this->drupalGet("node/{$node->id()}");
    $assert_session->pageTextContains('Powered by Drupal');

    // Add translation.
    $this->drupalGet("node/{$node->id()}/translations/add/en/es");

    // Add a new block.
    $this->clickLink('Add block');
    $assert_session->assertWaitOnAjaxRequest();

    $assert_session->linkExists('ID');
    $this->clickLink('ID');
    $assert_session->assertWaitOnAjaxRequest();

    $page->pressButton('Add block');
    $assert_session->assertWaitOnAjaxRequest();

    $page->pressButton('Save');

    $assert_session->pageTextContains('ID');
    $assert_session->pageTextContains($node->id());
  }

}
