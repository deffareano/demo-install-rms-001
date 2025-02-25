<?php

namespace Drupal\Tests\layout_builder_widget\FunctionalJavascript;

/**
 * Test Layout Builder Field is displayed.
 *
 * @group layout_builder_widget
 */
class LayoutBuilderWidgetFormDisplayTest extends LayoutBuilderWidgetBase {

  /**
   * Tests if layout builder widget is displayed on form-display configuration.
   */
  public function testLayoutBuilderFieldFormDisplayEnable(): void {
    $this->drupalGet("admin/structure/types/manage/{$this->contentType->id()}/form-display");

    $session = $this->getSession();
    $page = $session->getPage();

    $field_region = $page->findField("fields[layout_builder__layout][region]");

    // Check the region, it must be content.
    self::assertEquals('content', $field_region->getValue());
  }

  /**
   * Tests if layout builder widget is displayed on node edit form.
   *
   * @throws \Behat\Mink\Exception\ResponseTextException
   * @throws \Behat\Mink\Exception\ExpectationException|\Drupal\Core\Entity\EntityStorageException
   */
  public function testLayoutBuilderFieldOnNodeEditForm(): void {
    $this->drupalGet("node/add/{$this->contentType->id()}");

    $session = $this->getSession();
    $page = $session->getPage();

    $this->assertSession()->fieldExists('title[0][value]')->setValue('Test');

    $assert_session = $this->assertSession();

    // Add a new block.
    $this->clickLink('Add block');
    $assert_session->assertWaitOnAjaxRequest();

    $this->clickLink('Powered by Drupal');
    $assert_session->assertWaitOnAjaxRequest();

    $page->pressButton('Add block');
    $assert_session->assertWaitOnAjaxRequest();

    $page->pressButton('Save');

    // Check that added block exists on node view.
    $this->drupalGet("node/1");
    $assert_session->pageTextContains('Powered by Drupal');
  }

}
