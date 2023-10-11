<?php

namespace Drupal\plugin_type_example;

/**
 * Interface for sandwich plugins.
 */
interface SandwichInterface {

  /**
   * Returns the translated plugin label.
   *
   * @return string
   *   The translated title.
   */
  public function label();

}
