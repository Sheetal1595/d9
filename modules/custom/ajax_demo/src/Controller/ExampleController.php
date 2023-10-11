<?php
namespace Drupal\ajax_demo\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\OpenModalDialogCommand;
use Drupal\Core\Ajax\RedirectCommand;
use Drupal\Core\Ajax\CssCommand;



/**
 * Provides route responses for the Example module.
 */
class ExampleController extends ControllerBase {

  /**
   * Returns a simple page.
   *
   */
  public function content() {
   
    $build= [
      '#markup' => '<a href ="/drupal_task/result" class = "use-ajax" > Click me </a>',
    ];
    return $build;
  }
 public function result()
  {
    $response = new AjaxResponse();
    $dialog_options = [
        'minHeight'=>200,
        'resizable'=>TRUE
    ];
    //Create Modal  
    $title = "Hi, I am Sheetal";
    $content['#markup'] ="Something to show in the modal";
    $content['#attached']['library'][]='core/drupal.dialog.ajax';
    $response->addCommand(new OpenModalDialogCommand($title, $content, $dialog_options));

    //Redirect to URL
    $url = "https://www.google.com/";
    $response->addCommand(new RedirectCommand($url));

    // A string that contains the styles to be added to the page, including the wrapping <style> tag.
    $selector = '.page-title';
    $css = ['color' => 'red']; 
    // $response->addCommand(new CssCommand($selector,$css));
    return $response;

  }

}