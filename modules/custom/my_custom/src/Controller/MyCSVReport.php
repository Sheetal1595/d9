<?php

namespace Drupal\my_custom\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

/**
* Class MyCSVReport.
*
* @package Drupal\my_module\Controller
*/
class MyCSVReport extends ControllerBase  {

 /**
  * Drupal\Core\Entity\Query\QueryFactory definition.
  * Export a CSV of data.
  */
  public function build() {
    // Start using PHP's built in file handler functions to create a temporary file.
    $handle = fopen('php://temp', 'w+');
 
    // Set up the header that will be displayed as the first line of the CSV file.
    // Blank strings are used for multi-cell values where there is a count of
    // the "keys" and a list of the keys with the count of their usage.
    $header = [
      'Name',
      'Email',
      'Phone'
    ];
    // Add the header as the first line of the CSV.
    fputcsv($handle, $header);
    // Find and load all of the Article nodes we are going to include
    $result = \Drupal::database()->select('employee', 'n')
    ->fields('n', array('pid', 'name', 'email','number'))
    ->execute()->fetchAllAssoc('pid');
 
    // Iterate through the nodes.  We want one row in the CSV per Article.
    $rows = array();
    foreach ($result as $row => $content) {
      // echo $content;die;
      // $rows[] = array(
      //   'data' => array($content->pid, $content->name, $content->email,$content->number));
      
        $data = [
          $content->name,
          $content->email,
          $content->number
        ]; 
    
        
      // Add the data we exported to the next line of the CSV>
      fputcsv($handle, $data);
    }
    
    // Reset where we are in the CSV.
    rewind($handle);
    
    // Retrieve the data from the file handler.
    $csv_data = stream_get_contents($handle);
 
    // Close the file handler since we don't need it anymore.  We are not storing
    // this file anywhere in the filesystem.
    fclose($handle);
 
    // This is the "magic" part of the code.  Once the data is built, we can
    // return it as a response.
    $response = new Response();
 
    // By setting these 2 header options, the browser will see the URL
    // used by this Controller to return a CSV file called "article-report.csv".
    $response->headers->set('Content-Type', 'text/csv');
    $response->headers->set('Content-Disposition', 'attachment; filename="article-report.csv"');
 
    // This line physically adds the CSV data we created 
    $response->setContent($csv_data);
 
    return $response;
  }
  
 
}
  

