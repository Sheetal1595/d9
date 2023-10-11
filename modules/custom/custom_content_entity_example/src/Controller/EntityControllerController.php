<?php

namespace Drupal\custom_content_entity_example\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\node\NodeStorageInterface;
use Drupal\node\Entity\Node ;

/**
 * Returns responses for Entity controller routes.
 */
class EntityControllerController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {
    // $node = \Drupal::entityManager()->getStorage('node')->load(1);
    // dpm($node);

    $node = Node::load(1); 
    $title_field = $node->get('title'); 
    $title = $title_field->value; 
    dpm($title_field);
    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
