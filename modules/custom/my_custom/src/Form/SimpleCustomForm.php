<?php

namespace Drupal\my_custom\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;
//use Drupal\Core\Url;

class SimpleCustomForm extends FormBase {
  public function getFormId() {
    // Here we set a unique form id
    return 'employee';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
     // Textfield form element.
     $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Your Name'),
      '#required' => TRUE,
      ];

      $form['email'] = [
          '#type' => 'email',
          '#title' => $this->t('Your Email Address'),
          '#required' => TRUE,
      ];

      $form['number'] = [
      '#type' => 'tel',
      '#title' => $this->t('Your phone number'),
      '#required' => TRUE,
      ];
  $form['actions']['#type'] = 'actions';
  $form['actions']['submit'] = array(
    '#type' => 'submit',
    '#value' => $this->t('Save'),
    '#button_type' => 'primary',
  );
  return $form;
}

//   public function validateForm(array &$form, FormStateInterface $form_state) {
//      // Limit text length to 4.
//   $textfield_value = $form_state->getValue('custom_text_field');
//   if (strlen($textfield_value) < 4) {
//     $form_state->setErrorByName('custom_text_field', 'The text input must have at least 4 characters.');
//   }

//   // Limit maximum number value to 100.
//   $number_value = $form_state->getValue('custom_number_field');
//   if ($fnumber_value > 100) {
//     $form_state->setErrorByName('custom_number_field', 'Then number value cannot be greater than 100.');
//   }
// }
  

public function submitForm(array &$form, FormStateInterface $form_state) {
  //print_r($form_state);die;
  $conn = Database::getConnection();
  $conn->insert('employee')->fields(
    array(
      'name' => $form_state->getValue('name'),
      'email' => $form_state->getValue('email'),
      'number' => $form_state->getValue('number'),
    )
    
  )->execute();
  //print_r($form_state);die;
  //$url = Url::fromRoute('SimpleCustom.display');
  //$form_state->setRedirectUrl($url);
 }
}