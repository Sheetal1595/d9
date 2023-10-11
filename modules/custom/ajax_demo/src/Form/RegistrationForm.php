<?php
/**
 * @file
 * Contains \Drupal\ajax_demo\Form\RegistrationForm.
 */
namespace Drupal\ajax_demo\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Egulias\EmailValidator\EmailValidator;
use Drupal\Core\Messenger\MessengerInterface;
use Symfomy\component\DependencyInjection\DependencyInjection;
class RegistrationForm extends FormBase {
  /**
   * {@inheritdoc}
   */

  public function getFormId() {
    return 'registration_form';
}
public function buildForm(array $form, FormStateInterface $form_state) {
   
    $form['email'] = array(
      '#type' => 'email',
      '#title' => t('Enter Email ID:'),
      '#required' => TRUE,
    );
   
    $form['actions']['send'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Register'),
      '#button_type' => 'primary',
    );
    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    $value = $form_state->getValue('email');
    if($value == !\Drupal::service('email.validator')->isValid($value)) {
      $form_state->setErrorByName('email', $this->t('Please enter a valid email'));
    }
    
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $current_user = \Drupal::currentUser();
    if($current_user){
      \Drupal::messenger()->addMessage(t("Student Registration Done!! Registered Values are: $value"));
    }else{
      
      \Drupal::messenger()->addMessage(t("Student Registration Done!! Registered Values are:"));
    }
  }
}