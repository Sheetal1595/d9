<?php

namespace Drupal\drush9_batch_processing\Commands;

use Drupal\Core\Batch\BatchBuilder;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drush\Commands\DrushCommands;
use Psr\Log\LoggerInterface;

/**
 * A Drush commandfile.
 *
 * In addition to this file, you need a drush.services.yml
 * in root of your module, and a composer.json file that provides the name
 * of the services file to use.
 *
 * See these files for an example of injecting Drupal services:
 *   - http://cgit.drupalcode.org/devel/tree/src/Commands/DevelCommands.php
 *   - http://cgit.drupalcode.org/devel/tree/drush.services.yml
 */
class Drush9BatchProcessingCommands extends DrushCommands {

  use StringTranslationTrait;

  /**
   * Entity type service.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  private $entityTypeManager;

  /**
   * Logger service.
   *
   * @var \Drupal\Core\Logger\LoggerChannelFactoryInterface
   */
  private $loggerChannelFactory;

  /**
   * A logger instance.
   *
   * @var \Psr\Log\LoggerInterface
   */
  protected $logger;

  /**
   * Constructs a new UpdateVideosStatsController object.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   *   Entity type service.
   * @param \Drupal\Core\Logger\LoggerChannelFactoryInterface $loggerChannelFactory
   *   Logger service.
   * @param \Psr\Log\LoggerInterface $logger
   *   A logger instance.
   */
  public function __construct(EntityTypeManagerInterface $entityTypeManager, LoggerChannelFactoryInterface $loggerChannelFactory, LoggerInterface $logger) {
    parent::__construct();
    $this->entityTypeManager = $entityTypeManager;
    $this->loggerChannelFactory = $loggerChannelFactory;
    $this->logger = $logger;
  }

  /**
   * Update Node.
   *
   * @param string $type
   *   Type of node to update
   *   Argument provided to the drush command.
   *
   * @command update:node
   * @aliases update-node
   *
   * @usage update:node foo
   *   foo is the type of node to update
   */
  public function updateNode($type = '') {
    // 1. Log the start of the script.
    $this->loggerChannelFactory->get('drush9_batch_processing')->info($this->t('Update nodes batch operations start'));
    // Check the type of node given as argument, if not, set article as default.
    if ($type === '') {
      $type = 'article';
    }
    // 2. Retrieve all nodes of this type.
    try {
      $storage = $this->entityTypeManager->getStorage('node');
      $query = $storage->getQuery()
        ->condition('type', $type)
        ->condition('status', '1');
      $nids = $query->execute();
    }
    catch (\Exception $e) {
      $this->output()->writeln($e);
      $this->loggerChannelFactory->get('drush9_batch_processing')->warning($this->t('Error found @e', ['@e' => $e,]));
    }
    // 3. Create the operations array for the batch.
    $batchBuilder = new BatchBuilder();
    $numOperations = 0;
    $batchId = 1;
    if (!empty($nids)) {
      foreach ($nids as $nid) {
        // Prepare the operation. Here we could do other operations on nodes.
        $this->output()->writeln($this->t('Preparing batch: ') . $batchId);
        $batchBuilder->addOperation('\Drupal\drush9_batch_processing\BatchService::processMyNode', [
            $batchId,
            $this->t('Updating node @nid', ['@nid' => $nid,]),
        ]);
        $batchId++;
        $numOperations++;
      }
    }
    else {
      $this->logger->warning($this->t('No nodes of this type @type', ['@type' => $type,]));
    }
    // 4. Create the batch.
    $batchBuilder
      ->setTitle($this->t('Updating @num node(s)', ['@num' => $numOperations,]))
      ->setFinishCallback('\Drupal\drush9_batch_processing\BatchService::processMyNodeFinished')
      ->setErrorMessage(t('Batch has encountered an error'));
    // 5. Add batch operations as new batch sets.
    batch_set($batchBuilder->toArray());
    // 6. Process the batch sets.
    drush_backend_batch_process();
    // 6. Show some information.
    $this->logger->notice($this->t('Batch operations end.'));
    // 7. Log some information.
    $this->loggerChannelFactory->get('drush9_batch_processing')->info($this->t('Update batch operations end.'));
  }

}
