<?php

namespace Drupal\article_queue\Plugin\QueueWorker;

use Drupal\Core\Queue\QueueWorkerBase;
use Drupal\node\Entity\Node;
use Drupal\Core\Queue\QueueFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;
/**
 * Processes Node Tasks.
 *
 * @QueueWorker(
 *   id = "article_queue",
 *   title = @Translation("Task Worker: Node"),
 *   cron = {"time" = 10},
 *   
 * )
 */
class ArticleQueueProcessor extends QueueWorkerBase {
 

  /**
   * {@inheritdoc}
   */
  public function processItem($response) {
    // print_r($response->title);
  

    if (!empty($response->title)) {
      $node = Node::create([
        'type' => 'article',
      ]);
      $node->set('title', $response->title);
      // $node->set('created', $response->created);
      $body = [
        'value' => html_entity_decode($response->body->value),
        // 'format' => $response->body->format,
      ];
      $node->set('body', $body);
      $node->save();
    }
  }
}