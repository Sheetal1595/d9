<?php

namespace Drupal\batch_process\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class batchProcessForm.
 *
 * @package Drupal\batch_process\Form
 */
class batchProcessForm extends FormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'delete_node_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['delete_node'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Change Status'),
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $result = \Drupal::database()->select('mp_cv_submission', 'n')
    ->fields('n', array('cvsid', 'status'))
    // ->execute()->fetchAllAssoc('id');
    ->condition('status', '4', "=")
    ->execute()->fetchAll(\PDO::FETCH_OBJ);

    $batch = array(
      'title' => t('Change Node...'),
      'operations' => array(
        array(
          '\Drupal\batch_process\ChangeStatus::changeStatusExample',
          array($result)
        ),
      ),
      'finished' => '\Drupal\batch_process\ChangeStatus::changeStatusExampleFinishedCallback',
    );

    batch_set($batch);
  }

}