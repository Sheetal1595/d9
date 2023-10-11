<?php

namespace Drupal\country_detail_app\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\country_detail_app\CountryDetailApp;

/**
 * Class CountryDetailController.
 */
class CountryDetailController extends ControllerBase {


  // Protected $httpClient.
  /**
   * @inheritdoc
   */

  /**
   * GuzzleHttp\ClientInterface definition.
   *
   * @var \GuzzleHttp\ClientInterface
   */
  
  protected $countryDetail;

  /**
   * {@inheritdoc}
   */
  public function __construct(CountryDetailApp $countryDetail) {
    // $this->httpClient = $http_client.
    $this->countryDetail = $countryDetail;
  }

  /**
   * {@inheritdoc}.
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('country_detail_app.default')
    );
  }

  /**
   * Conterydetailpage.
   *
   * @return string
   *   Return Hello string.
   */
  public function countryDetailPage() {
    $rows = $this->countryDetail->getCountryDetails();
    $header = [
      'col1' => t('Name'),
      'col2' => t('Currencies'),
    ];
    return [
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
      '#attached' => [
        'library' => [
          'country_detail_app/globalcss',
        ],
      ],
    ];
  }

}