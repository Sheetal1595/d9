<?php

namespace Drupal\contactus\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides an example block.
 *
 * @Block(
 *   id = "contactus_example",
 *   admin_label = @Translation("ContactUs Form"),
 *   category = @Translation("ContactUs")
 * )
 */
class ContactusBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $form = \Drupal::formBuilder()->getForm('Drupal\contactus\Form\ContactUsForm');
    return $form;
  }

//   public function build() {
//     $build['content'] = [
//       '#markup' => $this->t('It works!'),
//     ];
//     return $build;
//   }

}
