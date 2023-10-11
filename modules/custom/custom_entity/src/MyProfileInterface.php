<?php

namespace Drupal\custom_entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a my_profile entity type.
 */
interface MyProfileInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
