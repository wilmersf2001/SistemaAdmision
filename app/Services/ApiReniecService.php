<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Models\Postulante;
use GuzzleHttp\Exception\RequestException;

class ApiReniecService
{
  public $token;

  public function __construct(string $token)
  {
    $this->token = $token;
  }

  public function getApplicantDataByDni(string $dni)
  {
    try {
      $client = new Client();
      $response = $client->get("https://dniruc.apisperu.com/api/v1/dni/{$dni}?token={$this->token}");
      $statusCode = $response->getStatusCode();

      if ($statusCode === 200) {
        $data = $response->getBody()->getContents();
        $response = json_decode($data, true);
        if (key_exists('message', $response)) return new Postulante();
        return Postulante::fromArrayReniec($response);
      } else {
        return new Postulante();
      }
    } catch (RequestException $e) {
      return new Postulante();
    }
  }

  public function getApoderadoDataByDni(string $dni)
  {
    try {
      $client = new Client();
      $response = $client->get("https://dniruc.apisperu.com/api/v1/dni/{$dni}?token={$this->token}");
      $statusCode = $response->getStatusCode();

      if ($statusCode === 200) {
        $data = $response->getBody()->getContents();
        $response = json_decode($data, true);
        if (key_exists('message', $response)) return [];
        return $response;
      } else {
        return [];
      }
    } catch (RequestException $e) {
      return [];
    }
  }
}
