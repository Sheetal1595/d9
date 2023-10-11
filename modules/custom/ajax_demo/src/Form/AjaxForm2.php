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
use Drupal\Core\Ajax\CommandInterface;
use Drupal\Core\Ajax\InvokeCommand;

use Drupal\ajax_demo\Ajax\ExampleCommand;

class AjaxForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'ajax_demo_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Create a select field that will update the contents of the textbox below.
    $form['select_branch_name'] = [
      '#type' => 'select',
      '#title' => $this->t('Select Branch Name'),
      '#options' => [
        '1' => $this->t('CSE'),
        '2' => $this->t('IT'),
        '3' => $this->t('EEE'),
        '4' => $this->t('ECE'),
      ],
      '#ajax' => [
        'callback' => '::myAjaxCallback', // Use :: when calling a class method.
        'disable-refocus' => FALSE, // Or TRUE to prevent re-focusing on the triggering element.
        'event' => 'change',
        'wrapper' => 'edit-output', // wrapper element is updated with this AJAX callback.
        'progress' => [
          'type' => 'throbber',
          'message' => $this->t('Verifying entry...'),
        ],
      ]
    ];
    // Create a textbox that will be updated
    // when the user selects an item from the select box above.
    $form['output'] = [
      '#type' => 'textfield',
      '#size' => '60',
      '#disabled' => TRUE,
      '#value' => 'Branch Names',      
      '#prefix' => '<div id="edit-output">',
      '#suffix' => '</div>',
    ];

    // Create the submit button.
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];
    return $form;
  }
  
public function myAjaxCallback(array &$form, FormStateInterface $form_state) {
  
  if ($selectedValue = $form_state->getValue('select_branch_name')) {
      
      $selectedText = $form['select_branch_name']['#options'][$selectedValue];
     
      $form['output']['#value'] = $selectedText;
  }
 
  return $form['output']; 
}

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Display result.
    foreach ($form_state->getValues() as $key => $value) {
      \Drupal::messenger()->addStatus($key . ': ' . $value);
    }
  }

}