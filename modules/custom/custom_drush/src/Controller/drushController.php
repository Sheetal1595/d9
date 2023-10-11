<?php
namespace Drupal\custom_drush\Controller;

use Drupal\Core\Controller\ControllerBase;

use Drupal\node\Entity\Node;
use Drush\Commands\DrushCommands;



/**
 * Provides route responses for the Example module.
 */
class drushController extends ControllerBase {

  /**
   * Returns a simple page.
   *
   */
  public function content() {
    $node = \Drupal\node\Entity\Node::load(3);
    $status = $node->get('status')->value;
    //  print_r($status);
    if($status==1){
      echo "active : ";
      $node->status = 0;
      $node->save();
      print_r($status);
    }
    elseif($status==0)
    {
      echo "inactive : ";
      $node->status = 1;
      $node->save();
      print_r($status);
    }
   die();
  }

  public function printMe($text = 'Hello world!', $options = ['uppercase' => FALSE]) {
    $node = \Drupal\node\Entity\Node::load(1);
    $status = $node->status;

     print_r('dsadgy');die;
    if ($options['uppercase']) {
      $text = strtoupper($text);
    }
    $this->output()->writeln($text);
  }
 
}