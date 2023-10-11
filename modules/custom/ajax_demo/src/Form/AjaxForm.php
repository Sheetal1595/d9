<?php
/**
 * @file
 * Contains \Drupal\ajax_demo\Form\AjaxForm.
 */
namespace Drupal\ajax_demo\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\ajax_demo\Ajax\ExampleCommand;

class AjaxForm extends FormBase {
  
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'ajax_demo_form';
  }
  
  public function buildForm(array $form, FormStateInterface $form_state) {
    $current_path = \Drupal::service('path.current')->getPath();
    // dpm($current_path);
    
    $form['name'] =array(
      '#type' => 'textfield',
      '#title' =>'Enter name'
    );

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Register'),
      '#button_type' => 'primary',
      '#ajax' =>[
        'callback' =>'::setMessage'
      ]

    );
    return $form;
  }
  
  public function validateForm(array &$form, FormStateInterface $form_state) {
  
  }
  
  public function submitForm(array &$form, FormStateInterface $form_state) {
  //   \Drupal::messenger()->addMessage(t("Student Registration Done!! Registered Values are:"));
	// foreach ($form_state->getValues() as $key => $value) {
	//   \Drupal::messenger()->addMessage($key . ': ' . $value);
  //   }
  }
  public function setMessage(array &$form, FormStateInterface $form_state) {
    \Drupal::messenger()->addMessage(t("Student Registration Done!! Registered Values are:"));
    $response = new AjaxResponse();
    $response->addCommand(new InvokeCommand('html','demo'));
    return $response;
  }

}