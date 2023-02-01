<?php
// File : src/Geocoding/OsmGeocoding.php

namespace App\Service;

use App\Entity\Adress;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Coordinates
{
  private $client;

  public function __construct(HttpClientInterface $client)
  {
    $this->client = $client;
  }

  /**
   * Geocodes a given location
   *
   * @param string $location
   * @return array|null
   */
  public function geocode(string $location): ?array
  {
    $response = $this->client->request(
      'GET',
      'https://nominatim.openstreetmap.org/search',
      [
        'query' => [
          'q' => $location,
          'format' => 'json',
          'limit' => '1'
        ]
      ]
    );

    $content = json_decode((string) ($response->getContent()), true);

    if (empty($content)) {
      return null;
    }

    $data['lat'] = $content[0]['lat'];
    $data['lon'] = $content[0]['lon'];

    return ( $data );
  }
}