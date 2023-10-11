<?php

namespace Drupal\ajax_demo\Ajax;

use Drupal\Core\Ajax\CommandInterface;

/**
 * Class ExampleCommand.
 */
class ExampleCommand implements CommandInterface {

  protected $message;

  public function __construct($message) {
    $this->message = $message;
  }

  /**
   * Render custom ajax command.
   *
   * @return ajax
   *   Command function.
   */
  public function render() {
    return [
      'command' => 'example',
      'message' => $this->message,
    ];
  }

}