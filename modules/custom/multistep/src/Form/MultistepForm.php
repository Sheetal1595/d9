<?php
/**
 * @file
 * Contains \Drupal\multistep\Form\MultistepForm.
 */
namespace Drupal\multistep\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
class MultistepForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'multistep_form';
  }
  
 
  public function buildForm(array $form, FormStateInterface $form_state) {

    if($form_state->has("cpage") && $form_state->has("cpage") == 2){
      return $this->secondForm($form,$form_state);
    }

  
    $form_state->set("cpage",1);

   

    $form['first_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('First Name'),
      '#default_value' => $form_state->getValue('first_name', ''),
      '#required' => TRUE,
    ];
    $form['firstnext']=[
      '#type'=>'submit',
      '#value'=>'Next',
      '#submit'=>['::firstNext'],
    ];
    return $form;
  
  }

  
  public function firstNext(array &$form, FormStateInterface $form_state) {
     
    $form_state->set("cpage",2);

      $form_state->set("data",[  
      'first_name'=>$form_state->getValue("first_name"),
      ]);
      $form_state->setRebuild(TRUE);
    }
 
   public function secondForm(array &$form, FormStateInterface $form_state) {
     $form['last_name']=[
       '#type'=>'textfield',
       '#title'=>'last Name'
     ];
     
 
     $form['secondBack']=[
      '#type'=>'submit',
      '#value'=>'Back',
      '#submit'=>['::secondBack'],
    ];

    
     $form['submit']=[
      '#type'=> 'submit',
      '#value'=> 'Submit',
    ];
     return $form;
   }
  
   public function secondBack(array &$form, FormStateInterface $form_state) {
     
     $form_state->setValues($form_state->get("data"));
     $form_state->set("cpage",1);
    //  $form_state->setRebuild(TRUE);
 
   }
 
   
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
  $first_name = $form_state->get("data");

  $data = array(
  
    // $first_name = $first_name,
    'last_name' => $form_state->getValue('last_name'),
  );
  $array = (array_merge($first_name,$data));

  \Drupal::database()->insert('multistep')->fields($array)->execute();
  \Drupal::messenger()->addStatus('Succesfully saved');
  // $response = new RedirectResponse('mapping/'.\Display);

  $url = Url::fromRoute('multistep.DisplayController');
  $form_state->setRedirectUrl($url);
  }
  }