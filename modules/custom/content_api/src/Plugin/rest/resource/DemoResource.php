<?php

namespace Drupal\content_api\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;

/**
 * Provides a Demo Resource
 *
 * @RestResource(
 *   id = "demo_resource",
 *   label = @Translation("Demo Resource"),
 *   uri_paths = {
 *     "create" = "http://localhost/D9/content_api/demo_resource"
 *     "canonical" = "http://localhost/D9/content_api/demo_resource"
 *     "https://www.drupal.org/link-relations/create" = "http://localhost/D9/content_api/demo_resource"
 *   }
 * )
 */


class DemoResource extends ResourceBase {

  /**
   * Responds to entity GET requests.
   * @return \Drupal\rest\ResourceResponse
   */
  public function get() {
    $response = ['message' => 'Hello, this is a rest service'];
    return new ResourceResponse($response);
  }
}