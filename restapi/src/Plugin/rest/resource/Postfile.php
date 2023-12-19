<?php

namespace Drupal\restapi\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Drupal\node\Entity\Node;

/**
 * Provides a Demo Resource
 *
 * @RestResource(
 *   id = "rest_api_demo",
 *   label = @Translation("Rest API listing"),
 *   uri_paths = {
 *     "create" = "add/rest_api_demosx"
 *   }
 * )
 */
class Postfile extends ResourceBase
{
  /**
   * Responds to entity GET requests.
   * @return \Drupal\rest\ResourceResponse
   */

  

  /**
   * Post api
   */
 public function post($data){
        try {
            // Create node
            $node = Node::create([
                'type' => 'article',
                'title' => $data['title'],
                'body' => $data['body'],
                'field_image' => [
                    'field_content_no' => $data['field_content_no']
                ],
              ]);
              $node->save();

              return new ResourceResponse('Node created successfully in '. $data['type']);
          } catch (EntityStorageException $e) {
            \Drupal::messenger()->addMessage(error($e->getMessage()));
          }
 }
}