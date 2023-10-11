<?php

namespace Drupal\custom_content_entity_example;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a profile entity type.
 */
interface ProfileInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
