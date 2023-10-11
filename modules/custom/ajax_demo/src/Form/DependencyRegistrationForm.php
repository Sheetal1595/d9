<?php
/**
 * @file
 * Contains \Drupal\ajax_demo\Form\DependencyRegistrationForm.
 */
namespace Drupal\ajax_demo\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Egulias\EmailValidator\EmailValidator;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DependencyRegistrationForm extends FormBase {
  /**
   * {@inheritdoc}
   */

  /**
   * Email validator
   * @var \Egulias\EmailValidator\EmailValidator
   */
  protected $emailValidator;
  protected $account;
  protected $messenger;

  public function _construct(EmailValidator $email_validator,AccountInterface $account, MessangerInterfnace $messanger)
  {
    $this->emailValidator = $email_validator;
    $this->account = $account;
    $this->messenger = $messenger;
  }

  public static function create(ContainerInterface $container){
    return new static(
      $container->get('email.validator'),
      $container->get('current_user'),
      $container->get('messenger')
      
    );
  }
  public function getFormId() {
    return 'dependency_registration_form';
}

/**
 * {@inheritdoc}
 */
public function buildForm(array $form, FormStateInterface $form_state) {
   
    $form['email'] = array(
      '#type' => 'textfield',
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

  public function validateEmail(array &$form, FormStateInterface $form_state) {
    $email = $form_state->getValue('email');
   
    if(!$this->emailValidator->isValid($email)) {
      print_r("hfuahfuh");die;
      return FALSE;
    }
    return TRUE;
    
  }
  public function validateForm(array &$form, FormStateInterface $form_state){
    $email = $form_state->getValue('email');
    if(!empty($email)){
      if(!$this->validateEmail($form,$form_state)){
        $form_state->setErrorByName('email',this->t("%email is an invalid email address", array('%email'=>$email)));
      }
    }else{
      $form_state->setErrorByName('email',this->t("Please enter an email address", array('%email'=>$email)));
    }
    $form_state->setValue('email',$email);
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