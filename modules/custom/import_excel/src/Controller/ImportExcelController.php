<?php

namespace Drupal\import_excel\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for import_excel routes.
 */
class ImportExcelController extends ControllerBase {

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
