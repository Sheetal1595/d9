<?php
namespace Drupal\ajax_demo\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\FormBase;

class diForm extends FormBase{

    public function getFormId(){
        return 'diForm';
    }

    public function buildForm( array $form, FormStateInterface $form_state, $placeholder = NULL)
    {
        $form['name'] =array(
            '#type' => 'textfield',
            '#title' =>'Enter name',
            '#maxlength' =>64,
            '#size' =>64,
        );
        $form['message'] =array(
            '#type' => 'textfield',
            '#title' =>'Enter name',
            '#rows' =>5,
        );
        $form['submit'] = array(
            '#type' => 'submit',
            '#value' => $this->t('Register'),
            '#button_type' => 'primary',    
          );      
          return $form;
    }

    public function submitForm(array $form, FormStateInterface $form_state){
        
    }
}
?>