<?php

namespace Drupal\Tests\audit_log\Kernel;

use Drupal\KernelTests\KernelTestBase;
use Drupal\user\Entity\User;

/**
 * Tests the audit log database logger.
 *
 * @group audit_log
 */
class AuditLogDatabaseTest extends KernelTestBase {
  /**
   * {@inheritdoc}
   */
  protected static $modules = ['system', 'user', 'audit_log'];

  /**
   * {@inheritdoc}
   */
  protected function setUp() : void {
    parent::setUp();

    $this->installSchema('system', ['sequences']);
    $this->installEntitySchema('user');
    $this->installEntitySchema('audit_log');
  }

  /**
   * Verifies that user events are written to the database.
   */
  public function testUserAuditLog() {
    $count = \Drupal::database()->query('SELECT COUNT(id) FROM {audit_log}')->fetchField();
    $this->assertEquals(0, $count);

    $user = User::create(['name' => 'test name']);
    $user->save();

    $count = \Drupal::database()->query('SELECT COUNT(id) FROM {audit_log}')->fetchField();
    $this->assertEquals(1, $count);
    $user->save();

    $count = \Drupal::database()->query('SELECT COUNT(id) FROM {audit_log}')->fetchField();
    $this->assertEquals(2, $count);
  }

}
