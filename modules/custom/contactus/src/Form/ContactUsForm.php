<?php
/**
 * @file
 * Contains \Drupal\contactus\Form\ContactUsForm.
 */
namespace Drupal\contactus\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\JsonResponse;

class ContactUsForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  
public function getFormId() {
    return 'contact_us_form';
}
public function buildForm(array $form, FormStateInterface $form_state) {
    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => t('Enter Name:'),
      '#required' => TRUE,
    );
   
    $form['mobile'] = array(
      '#type' => 'tel',
      '#title' => t('Enter Phone Number:'),
      '#required' => TRUE,
    );
    $form['mail'] = array(
      '#type' => 'email',
      '#title' => t('Enter Email ID:'),
      '#required' => TRUE,
    );
  
    $form['dob'] = array (
      '#type' => 'date',
      '#title' => t('Enter DOB:'),
      '#required' => TRUE,
    );
    $form['message'] = array (
      '#type' => 'textarea',
      '#title' => ('Your Message'),
    
    );
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('contact'),
      '#button_type' => 'primary',
    );
    return $form;
  }
    public function validateForm(array &$form, FormStateInterface $form_state) {
     
      $value = $form_state->getValue('mail');
        if(strlen($form_state->getValue('mobile')) < 10) {
          $form_state->setErrorByName('mobile', $this->t('Please enter a valid Contact Number'));
          }

        if ($value == !\Drupal::service('email.validator')->isValid($value)) {
          $form_state->setErrorByName(
            'email',
            t('The email address %mail is not valid.', array('%mail' => $value)));
        }
    }
    
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $data = array(
  
           
            'name' => $form_state->getValue('name'),
            'mobile' => $form_state->getValue('mobile'),
            'gmail' => $form_state->getValue('mail'),
            'dob' => $form_state->getValue('dob'),
            'message' => $form_state->getValue('message'),
          );    
      
          \Drupal::database()->insert('contact_us')->fields($data)->execute();
          \Drupal::messenger()->addStatus('Succesfully saved');      

            $url = Url::fromRoute('contactus.DisplayController');         
            $form_state->setRedirectUrl($url);
    }
}