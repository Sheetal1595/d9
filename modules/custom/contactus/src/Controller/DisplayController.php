<?php

namespace Drupal\contactus\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

use Symfony\Component\HttpFoundation\JsonResponse;



/**
 * Returns responses for ContactUS routes.
 */
class DisplayController extends ControllerBase {

  /**
   * Builds the response.
   */
  
  public function getDetails() {
    $header_table = array(
      'id' => t('ID'),
      'Name' => t('name'),
      'Mobile' => t('mobile'),
      'Gmail' => t('Gmail'),
      'Dob' => t('Date of Birth'),
      // 'Message' => t('Message'),
     
    );

      $db = \Drupal::database(); 
      $query = $db->select('contact_us', 'id'); 
      $query->fields('id'); 
      $response = $query->execute()->fetchAll();
        // return new JsonResponse( $response );


      
      foreach ($response as $data) {
        $id = Url::fromRoute('contactus.DisplayController', ['id' => $data->id], []);
        
        //get data
        $rows[] = array(
          'id' => $data->id,
          'name' => $data->name,
          'mobile' => $data->mobile,
          'gmail' => $data->gmail,
          'dob' => $data->dob,
          // 'message' => $data->message,

        );
  
      }
      // render table
      $form['table'] = [
        '#type' => 'table',
        '#header' => $header_table,
        '#rows' => $rows,
        '#empty' => t('No data found'),
      ];
      return $form;
  }
}
