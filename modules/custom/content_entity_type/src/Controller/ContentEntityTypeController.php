<?php

namespace Drupal\content_entity_type\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for [A[A[A[B[B[Bcontent_entity_type routes.
 */
class ContentEntityTypeController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
