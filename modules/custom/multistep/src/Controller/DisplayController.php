<?php

namespace Drupal\multistep\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

use Symfony\Component\HttpFoundation\JsonResponse;



/**
 * Returns responses for Multistep routes.
 */
class DisplayController extends ControllerBase {

  /**
   * Builds the response.
   */
  
  public function getDetails() {
    $header_table = array(
      'id' => t('ID'),
      'First Name' => t('first_name'),
      'Last Name' => t('last_name'),
     
    );

    $db = \Drupal::database(); 
    $query = $db->select('multistep', 'id'); 
    $query->fields('id'); 
    $response = $query->execute()->fetchAll();
      // return new JsonResponse( $response );


      
      foreach ($response as $data) {
        $id = Url::fromRoute('multistep.DisplayController', ['id' => $data->id], []);
        
        //get data
        $rows[] = array(
          'id' => $data->id,
          'first_name' => $data->first_name,
          'last_name' => $data->last_name,

        );
  
      }
      // render table
      $form['table'] = [
        '#type' => 'table',
        '#header' => $header_table,
        '#rows' => $rows,
        '#empty' => t('No data found'),
      ];
      // return $form;
      // echo "<pre>";
      // print_r($rows);
   
    return [

      '#theme' => 'my-template',
      '#items' => $rows,
      
        ];
    }

   
}
