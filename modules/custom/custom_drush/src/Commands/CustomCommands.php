<?php

namespace Drupal\custom_drush\Commands;

use Drush\Commands\DrushCommands;
use Drupal\node\Entity\Node;

 

/**

 * Drush command file.

 */

class CustomCommands extends DrushCommands {

  /**

   * A custom Drush command to Change the Status of Node.

   *
   * @command drush-status-change:nodeC 
   * @param $nid 
   * @param $st
   * @aliases ccepm,cce-print-me
   */

  public function nodeC($nid = 0, $st = 0) {

    $node = \Drupal\node\Entity\Node::load($nid);

    if($st>1){
      $this->output()->writeln("Second argument Should be 0 or 1");
      exit;
    }else{
      $node->status = $st;
      $node->save();
    }
   
}

}