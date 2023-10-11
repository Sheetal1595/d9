<?php
namespace Drupal\basic_page\Controller;
use Drupal\Core\Controller\ControllerBase;

/// call multiple pages from single controller file 


class BasicPageController extends ControllerBase{
    public function basicPage(){
        return [
            '#title' =>'Basic Page Information',
            '#markup' => '<h2>This is our heading</h2>'
        ];
    }
// call twig template file 
    public function information()
    {
        $data = array(
            'name' => "Sheetal",
            'email' => "Sheetal@gmail.com"
        );
        return [
            '#title' =>'Information Page ',
            '#theme' => 'information-page',
            '#items' => $data 

            
        ];
    }
}
?>