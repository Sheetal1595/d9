<?php
namespace Drupal\content_module\Controller;
class ContentController {
  public function content() {
    $nids = \Drupal::entityQuery('node')->condition('type','article')->execute();
    $nodes =  \Drupal\node\Entity\Node::loadMultiple($nids);


    // echo"<pre>";
    // print_r( $nodes );die;
  }


 
}