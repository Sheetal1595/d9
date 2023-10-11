<?php
/**
 * @file
 * Contains \Drupal\multistep\Form\MultistepForm.
 */
namespace Drupal\multistep\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
class Display extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'display';
  }
  
 
  public function buildForm(array $form, FormStateInterface $form_state) {

   echo "hi";die;
  }

  
   
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
 
  }}