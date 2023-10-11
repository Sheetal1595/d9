<?php

namespace Drupal\content_entity_type;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Defines the access control handler for the profile[d[d[d[d[d[d[dmy_profile entity type.
 */
class MyProfileAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {

    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view profile[d[d[d[d[d[d[dmy_profile');

      case 'update':
        return AccessResult::allowedIfHasPermissions(
          $account,
          ['edit profile[d[d[d[d[d[d[dmy_profile', 'administer profile[d[d[d[d[d[d[dmy_profile'],
          'OR',
        );

      case 'delete':
        return AccessResult::allowedIfHasPermissions(
          $account,
          ['delete profile[d[d[d[d[d[d[dmy_profile', 'administer profile[d[d[d[d[d[d[dmy_profile'],
          'OR',
        );

      default:
        // No opinion.
        return AccessResult::neutral();
    }

  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermissions(
      $account,
      ['create profile[d[d[d[d[d[d[dmy_profile', 'administer profile[d[d[d[d[d[d[dmy_profile'],
      'OR',
    );
  }

}
