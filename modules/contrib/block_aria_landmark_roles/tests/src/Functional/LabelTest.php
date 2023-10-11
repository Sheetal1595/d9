<?php

namespace Drupal\Tests\block_aria_landmark_roles\Functional;

use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Tests\BrowserTestBase;

/**
 * Test adding ARIA labels.
 *
 * @group block_aria_landmark_roles
 */
class LabelTest extends BrowserTestBase {

  use StringTranslationTrait;

  /**
   * Default theme.
   *
   * @var string
   */
  protected $defaultTheme = 'stark';

  /**
   * {@inheritdoc}
   */
  protected static $modules = [
    'block',
    'block_aria_landmark_roles',
  ];

  /**
   * Test adding an ARIA label to a block.
   *
   * @throws \Behat\Mink\Exception\ExpectationException
   */
  public function testAddingLabel() {
    $output = 'id="block-stark-mainpagecontent" aria-label="foo"';

    $this->assertSession()->responseNotContains($output);

    $this->drupalLogin($this->createUser(['administer blocks']));
    $this->drupalGet('admin/structure/block/add/system_main_block/stark');

    $this->submitForm([
      'region' => 'content',
      'third_party_settings[block_aria_landmark_roles][label]' => 'foo',
    ], $this->t('Save block'));

    $this->assertSession()->responseContains($output);
  }

  /**
   * Ensure the ARIA label input field exists.
   *
   * @throws \Behat\Mink\Exception\ElementNotFoundException
   */
  public function testAdminFormSetting() {
    $this->drupalLogin($this->drupalCreateUser(['administer blocks']));

    $this->drupalGet('admin/structure/block/add/system_main_block/stark');

    $this->assertSession()->fieldExists('third_party_settings[block_aria_landmark_roles][label]');
  }

}
