<?php

namespace Drupal\batch_process;


use Drupal\node\Entity\Node;

class ChangeStatus {

  public static function changeStatusExample($nids, &$context){
    $message = 'Changing the Status...';
    $results = array();
    

    
    $result = \Drupal::database()->select('mp_cv_submission', 'n')
    ->fields('n', array('cvsid', 'status'))
    // ->execute()->fetchAllAssoc('id');
    ->condition('status', '0', "=")
    ->execute()->fetchAll(\PDO::FETCH_OBJ);

    $results = \Drupal::database()->update('mp_cv_submission')
    ->condition('status', '0', "=")
    ->expression('status', "REPLACE(status, :old_value, :new_value)", [
      ':old_value' => '0',
      ':new_value' => '8',
    ])
    ->execute();
    // echo "<pre>";
    // print_r($query);die();
    $context['message'] = $message;
    $context['results'] = $results;
  }

  function changeStatusExampleFinishedCallback($success, $results, $operations) {
    // The 'success' parameter means no fatal PHP errors were detected. All
    // other error management should be handled using 'results'.
    if ($success) {
      $message = \Drupal::translation()->formatPlural(
        count($results),
        'One post processed.', '@count posts processed.'
      );
    }
    else {
      $message = t('Finished with an error.');
    }
    drupal_set_message($message);
  }
}