<?php

namespace Drupal\batch_import_album\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Serialization\Json;
use Drupal\node\Entity\Node;

/**
 * Provides a form for deleting a batch_import_example entity.
 *
 * @ingroup batch_import_example
 */
class ImportForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() : string {
    return 'batch_import_album_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['#prefix'] = '<p>This example form will import  album from the "https://jsonplaceholder.typicode.com/photos" </p>';

    $form['actions'] = array(
      '#type' => 'actions',
      'submit' => array(
        '#type' => 'submit',
        '#value' => 'Proceed',
      ),
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $host = \Drupal::request()->getHost();
    //  $url = $host . '/d9/' . drupal_get_path('module', 'batch_import_album') . '/docs/album.json';
    echo $url = "https://jsonplaceholder.typicode.com/photos";
    // echo "<pre>";print_r($url);die;
    $request = \Drupal::httpClient()->get($url);
    $body = $request->getBody();
    $data = Json::decode($body);
    $total = count($data);
  
      $i = 0;
    foreach ($data as $item) {     
      if ($i++ > 10) {
      
      $operations[] = [[$this, 'importAlbum'], [$item]];
       
      }
      // break; 
    }
    

    $batch = [
    'title' => t('Importing album'),
    'operations' => $operations,
    'init_message' => t('Import process is starting.'),
    'progress_message' => t('Processed @current out of @total. Estimated time: @estimate.'),
    'error_message' => t('The process has encountered an error.'),
    ];
  

    batch_set($batch);
    \Drupal::messenger()->addMessage('Imported  10 albums!');

    $form_state->setRebuild(TRUE);
  }

  /**
   * @param $entity
   * Deletes an entity
   */
  public function importAlbum($item, &$context) {

 
    
    $entity = Node::create([
        'type' => 'album',
        'langcode' => 'und',
        'title' => $item['title'],
        'field_albumid' => $item['albumId'],
        'field_id' => $item['id'],
        'field_url' => $item['url'],
        'field_thumbnailurl' => $item['thumbnailUrl'],
      ]
    );
    // print_r($entity);die;
    $entity->save();
    $context['results'][] = $item['type'];
    $context['message'] = t('Created @title', array('@title' => $item['title']));
  }

}
