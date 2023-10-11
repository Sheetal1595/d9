<?php
    namespace Drupal\employee\Form;
    use Drupal\Core\Form\FormBase;
    use Drupal\Core\Form\FormStateInterface;
    use Drupal\Core\Database\Database;

    class EmployeeForm extends FormBase{
        /**
         * {@inheritdoc}
         */
        public function getFormId() {
            return 'create_employee';
        }

        public function buildForm(array $form, FormStateInterface $form_state) {
            $form['employee_name'] = array(
              '#type' => 'textfield',
              '#title' => t('Enter Name:'),
              '#required' => TRUE,
            );
           
            $form['employee_mail'] = array(
              '#type' => 'email',
              '#title' => t('Enter Email ID:'),
              '#required' => TRUE,
            );
            $form['employee_phone'] = array (
              '#type' => 'tel',
              '#title' => t('Enter Contact Number'),
            );
            $form['employee_dob'] = array (
              '#type' => 'date',
              '#title' => t('Enter DOB:'),
              '#required' => TRUE,
            );
            $form['employee_gender'] = array (
              '#type' => 'select',
              '#title' => ('Select Gender:'),
              '#options' => array(
                'Male' => t('Male'),
                'Female' => t('Female'),
                'Other' => t('Other'),
              ),
            );
            $form['actions']['#type'] = 'actions';
            $form['actions']['submit'] = array(
              '#type' => 'submit',
              '#value' => $this->t('Register'),
              '#button_type' => 'primary',
            );
            return $form;
          }

        public function submitForm(array &$form, FormStateInterface $form_state) {
        $post_data = $form_state->getValues();
        
        $query = \Drupal::database();
        $quert->insert('Employee')->fields($post_data)->execute();
       
        }
    }
?>