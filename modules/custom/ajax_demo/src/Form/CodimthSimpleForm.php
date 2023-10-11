<?php
// uppercase_name 

namespace Drupal\ajax_demo\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\ajax_demo\Ajax\ExampleCommand;


/**
 * Class CodimthSimpleForm
 * @package Drupal\codimth_form_api\Form
 */
class CodimthSimpleForm extends FormBase
{
  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'codimth_form_api_ajax_demo';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {

    $form['uppercase_name'] = [
      '#type' => 'markup',
      '#markup' => '<div class="result_message"></div>',
    ];

    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
    ];

    $form['actions'] = [
      '#type' => 'button',
      '#value' => $this->t('Uppercase Name'),
      '#ajax' => [
        'callback' => '::uppercaseName',
        'progress' => array(
          'type' => 'throbber',
          'message' => 'in progress ...',
        ),
      ],
    ];
    return $form;
  }

  /**
   * @param array $form
   * @param FormStateInterface $form_state
   * @return AjaxResponse
   */
  public function uppercaseName(array $form, FormStateInterface $form_state)
  {
   
    dpm("in uppercase function");
    die("uppercaseName");
    $message = 'The result is '.strtoupper($form_state->getValue('name'));
    $response = new AjaxResponse();
   
    $response->addCommand(
      new ExampleCommand($message)
    );
    return $response;
  }

  /**
   * @param array $form
   * @param FormStateInterface $form_state
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    
  }
}