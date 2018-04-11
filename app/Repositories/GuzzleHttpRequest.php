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
    $response = $this->client->request('GET', $this->GetUrl($url) , $query);

    return json_decode($response->getBody()->getContents());
  }

  public function GetUrl($url)
  {
    return env('WS_RESOURCE', 'hepta').'/'.$url;
  }
}
