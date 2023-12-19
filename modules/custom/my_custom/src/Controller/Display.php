<?php

namespace Drupal\my_custom\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Class Display.
 *
 * @package Drupal\my_custom\Controller
 */
class Display extends ControllerBase {

  /**
   * showdata.
   *
   * @return string
   *   Return Table format data.
   */
  public function showdata() {

// you can write your own query to fetch the data I have given my example.

    $result = \Drupal::database()->select('employee', 'n')
            ->fields('n', array('pid', 'name', 'email','number'))
            ->execute()->fetchAllAssoc('pid');
// Create the row element.
  //   $rows = array();
  //   foreach ($result as $row => $content) {
  //     $rows[] = array(
  //       'data' => array($content->pid, $content->name, $content->email,$content->number));
  //   }
  //  echo " <a href='exports/articles' class='button'>Export CSV</a>";
  //  echo " <a href='simple-custom-form' class='button'>Regsiter</a>";

// Create the header.
    // $header = array('pid', 'name', 'email','number');
    // $output = array(
    //   '#theme' => 'table',    // Here you can write #type also instead of #theme.
    //   '#header' => $header,
    //   '#rows' => $rows
    // );
    //return $output;
    //print_r($output);die;
    return [
      '#theme' => 'mytemplate',
      '#items' => $result,
      '#attached' => [
        'library' => [
          'my_custom/custom',
        ],
      ]
    ];

  }
}
  
