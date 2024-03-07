<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Models\Postulante;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class ApiReniecService
{
  public $dniUser;
  public $rucUser;


  public function __construct(string $dniUser, string $rucUser)
  {
    $this->dniUser = $dniUser;
    $this->rucUser = $rucUser;
  }

  public function getApplicantDataByDni(string $dni)
  {
    try {
      $client = new Client();
      $response = $client->post("https://ws5.pide.gob.pe/Rest/Reniec/Consultar?out=json", [
        'headers' => [
          'Accept' => 'application/json',
          'Content-Type' => 'application/json'
        ],
        'json' => [
          'PIDE' => [
            'nuDniConsulta' => $dni,
            'nuDniUsuario' => $this->dniUser,
            'nuRucUsuario' => $this->rucUser,
            'password' => '75085359',
          ],
        ],
      ]);

      $statusCode = $response->getStatusCode();

      if ($statusCode === 200) {
        $data = $response->getBody()->getContents();
        $response = json_decode($data, true);

        if (isset($response['consultarResponse']['return']['coResultado'])) {
          $coResultado = $response['consultarResponse']['return']['coResultado'];
          if ($coResultado == '0000') {
            $dataPostulante = $response['consultarResponse']['return']['datosPersona'];
            $dataPostulante['dni'] = $dni;
            return Postulante::fromArrayReniec($dataPostulante);
          }
          return new Postulante();
        }
        return new Postulante();
      }
      return new Postulante();
    } catch (RequestException $e) {
      return new Postulante();
    }
  }

  public function getApoderadoDataByDni(string $dni)
  {
    try {
      $client = new Client();
      $response = $client->post("https://ws5.pide.gob.pe/Rest/Reniec/Consultar?out=json", [
        'headers' => [
          'Accept' => 'application/json',
          'Content-Type' => 'application/json'
        ],
        'json' => [
          'PIDE' => [
            'nuDniConsulta' => $dni,
            'nuDniUsuario' => $this->dniUser,
            'nuRucUsuario' => $this->rucUser,
            'password' => '75085359',
          ],
        ],
      ]);

      $statusCode = $response->getStatusCode();

      if ($statusCode === 200) {
        $data = $response->getBody()->getContents();
        $response = json_decode($data, true);

        if (isset($response['consultarResponse']['return']['coResultado'])) {
          $coResultado = $response['consultarResponse']['return']['coResultado'];
          if ($coResultado == '0000') {
            $response = $response['consultarResponse']['return']['datosPersona'];
            $response['dni'] = $dni;
            return $response;
          }
          return [];
        }
        return [];
      }
      return [];
    } catch (RequestException $e) {
      return [];
    }
  }

  public function updateCredentials($nuDni, $credencialAnterior, $credencialNueva)
  {
    $client = new Client();
    $response = $client->post("https://ws5.pide.gob.pe/Rest/Reniec/ActualizarCredencial?out=json", [
      'headers' => [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json'
      ],
      'json' => [
        'PIDE' => [
          'credencialAnterior' => $credencialAnterior,
          'credencialNueva' => $credencialNueva,
          'nuDni' => $nuDni,
          'nuRuc' => $this->rucUser,
        ],
      ],
    ]);

    $statusCode = $response->getStatusCode();

    if ($statusCode === 200) {
      $data = $response->getBody()->getContents();
      $response = json_decode($data, true);

      if (isset($response['actualizarcredencialResponse']['return']['coResultado'])) {
        $coResultado = $response['actualizarcredencialResponse']['return']['coResultado'];
        $message = $response['actualizarcredencialResponse']['return']['deResultado'];
        if ($coResultado == '0000') {
          return $message;
        }
        return $message;
      }
      return 'Error al actualizar credenciales';
    }
    return 'Error al actualizar credenciales';
  }
}
