<?php

namespace Drupal\contactus\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides an example block.
 *
 * @Block(
 *   id = "contactus_example",
 *   admin_label = @Translation("Example"),
 *   category = @Translation("ContactUs")
 * )
 */
class ExampleBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
    public function build() {
      $form = \Drupal::formBuilder()->getForm('Drupal\contactus\Form\ContactUsForm');
      return $form;
    }
  

}
