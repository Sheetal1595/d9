<?php

namespace Drupal\country_detail_app;

use GuzzleHttp\ClientInterface;
use Drupal\Component\Render\FormattableMarkup;

/**
 * Class CountryDetailApp.
 */
class CountryDetailApp {

  /**
   * GuzzleHttp\ClientInterface definition.
   *
   * @var \GuzzleHttp\ClientInterface
   */
  protected $httpClient;

  /**
   * Constructs a new CountryDetailApp object.
   */
  public function __construct(ClientInterface $http_client) {
    $this->httpClient = $http_client;
  }

  /**
   * Implements connectApi.
   */
  public function getCountryDetails() {
    $endpoint = "https://restcountries.com/v2/all?fields=name&fields=currencies";
    try {
      $response = $this->httpClient->get($endpoint,
      ['headers' => ['Accept' => 'application/json']]);
      $data = $response->getBody()->getContents();
      $data = json_decode($data);
      $rows = [];
      foreach ((array) $data as $item) {
        $value = new FormattableMarkup('<div class="tooltip">
  <span class="tooltiptext">@Tooltip</span>
</div>', ['@Tooltip' => $item->currencies[0]->name]);
        $rows[] = [$item->name, $value];

      }

      return $rows;
    }
    catch (RequestException $e) {
      return FALSE;
    }
  }

}