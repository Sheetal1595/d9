<?php

namespace Drupal\employee\Controller;
use Drupal\Core\Controller\ControllerBase;

class EmployeeController extends ControllerBase{
    // this function is used to call custom form via Controller
    public function createEmployee(){
        $form = \Drupal::formbuilder()->getForm('Drupal\employee\Form\EmployeeForm');
        // $rendererform = \Drupal::service('renderer')->render($form); // used to render form via controller

        //**********render from controller */
        // return [
        //     '#type' =>'markup',
        //     '#markup' => $rendererform,
        // ];  

     //**********render from twig template */

        return [
            '#theme' =>'employee',
            '#items' => $form,
            '#title' => 'Employwee Form'
        ];
    }
}

?>