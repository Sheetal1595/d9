<?php 
namespace Drupal\article_queue\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Queue\QueueFactory;
use Drupal\Core\Queue\QueueInterface;
use Drupal\Core\Routing\RouteMatchInterface;

class ArticleController extends ControllerBase {



  public function qControllerMethod() {
    // Use the service to add an item to the queue.

    $queue = \Drupal::queue('article_queue');
   
    // Create item
    $item = array(
      'name' => 'Sheetal',
      'no' => 123
    );
   
   
    // Add item to queue
    $queue->createItem($item);
  //  echo "<pre>";
  
    
    
    // return ; 

  }

 
}


