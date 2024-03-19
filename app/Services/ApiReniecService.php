<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Models\Setting;
use App\Models\Postulante;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

class ApiReniecService
{
  public $rucUser;

  public function __construct(string $rucUser)
  {
    $this->rucUser = $rucUser;
  }

  public function getApplicantDataByDni(Setting $setting, string $dni)
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
            'nuDniUsuario' => $setting->nuDniUsuario,
            'nuRucUsuario' => $this->rucUser,
            'password' => Crypt::decryptString($setting->password),
          ],
        ],
      ]);

      $statusCode = $response->getStatusCode();

      if ($statusCode === 200) {
        $data = $response->getBody()->getContents();
        $response = json_decode($data, true);
        $setting->update([
          'numeroConsultas' => $setting->numeroConsultas + 1,
        ]);

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

  public function getApoderadoDataByDni(Setting $setting, string $dni)
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
            'nuDniUsuario' => $setting->nuDniUsuario,
            'nuRucUsuario' => $this->rucUser,
            'password' => Crypt::decryptString($setting->password),
          ],
        ],
      ]);

      $statusCode = $response->getStatusCode();

      if ($statusCode === 200) {
        $data = $response->getBody()->getContents();
        $response = json_decode($data, true);
        $setting->update([
          'numeroConsultas' => $setting->numeroConsultas + 1,
        ]);

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
    try {
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
    } catch (RequestException $e) {
      return 'Error al actualizar credenciales';
    }
  }
}
