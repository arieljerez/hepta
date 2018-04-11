<?php
namespace App\Repositories;
use GuzzleHttp\Client;

Class GuzzleHttpRequest
{
  protected $client;

  public function __construct(Client $client)
  {
    $this->client = $client;
  }

  public function get($url,$query)
  {
    $response = $this->client->request('GET',$url, $query);

    return json_decode($response->getBody()->getContents());
  }
}
