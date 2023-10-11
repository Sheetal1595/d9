<?php

namespace Drupal\content_entity_type;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a profile[d[d[d[d[d[d[dmy_profile entity type.
 */
interface MyProfileInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
