<?php

namespace Drupal\Tests\block_aria_landmark_roles\Functional;

use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Tests\BrowserTestBase;

/**
 * Test adding ARIA roles.
 *
 * @group block_aria_landmark_roles
 */
class RoleTest extends BrowserTestBase {

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
   * Test that an ARIA role can be added to a block.
   *
   * @throws \Behat\Mink\Exception\ExpectationException
   */
  public function testAddingRole() {
    $output = 'div id="block-stark-mainpagecontent" role="banner"';

    $this->assertSession()->responseNotContains($output);

    $this->drupalLogin($this->createUser(['administer blocks']));
    $this->drupalGet('admin/structure/block/add/system_main_block/stark');

    $this->submitForm([
      'region' => 'content',
      'third_party_settings[block_aria_landmark_roles][role]' => 'banner',
    ], $this->t('Save block'));

    $this->assertSession()->responseContains($output);
  }

  /**
   * Ensure the ARIA role input field exists.
   *
   * @throws \Behat\Mink\Exception\ElementNotFoundException
   */
  public function testAdminFormSetting() {
    $this->drupalLogin($this->drupalCreateUser(['administer blocks']));

    $this->drupalGet('admin/structure/block/add/system_main_block/stark');

    $this->assertSession()->fieldExists('third_party_settings[block_aria_landmark_roles][role]');
  }

}
