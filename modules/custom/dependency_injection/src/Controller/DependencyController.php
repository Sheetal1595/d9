<?php
namespace Drupal\dependency_injection\Controller;
class DependencyController {
  public function welcome() {
    return array(
      '#markup' => 'Welcome to our Website.'
    );
  }
}