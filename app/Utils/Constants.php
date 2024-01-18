<?php

namespace App\Utils;

class Constants
{
  //RUTAS DE FOTOS ISCRIPCION
  public const RUTA_FOTO_QR = 'temp/';
  public const RUTA_FOTO_CARNET_VALIDA = 'archivos_validos/foto_carnet/';
  public const RUTA_DNI_ANVERSO_VALIDA = 'archivos_validos/dni_anverso/';
  public const RUTA_DNI_REVERSO_VALIDA = 'archivos_validos/dni_reverso/';
  public const RUTA_FOTO_CARNET_INSCRIPTO = 'archivos_inscripcion/foto_carnet/';
  public const RUTA_DNI_ANVERSO_INSCRIPTO = 'archivos_inscripcion/dni_anverso/';
  public const RUTA_DNI_REVERSO_INSCRIPTO = 'archivos_inscripcion/dni_reverso/';
  public const RUTA_FOTO_CARNET_OBSERVADO = 'archivos_observados/foto_carnet/';
  public const RUTA_DNI_ANVERSO_OBSERVADO = 'archivos_observados/dni_anverso/';
  public const RUTA_DNI_REVERSO_OBSERVADO = 'archivos_observados/dni_reverso/';
  public const RUTA_FOTO_CARNET_RECTIFICADO = 'archivos_rectificados/foto_carnet/';
  public const RUTA_DNI_ANVERSO_RECTIFICADO = 'archivos_rectificados/dni_anverso/';
  public const RUTA_DNI_REVERSO_RECTIFICADO = 'archivos_rectificados/dni_reverso/';
  public const RUTA_FOTOS_VALIDAS = [Constants::RUTA_FOTO_CARNET_VALIDA, Constants::RUTA_DNI_ANVERSO_VALIDA, Constants::RUTA_DNI_REVERSO_VALIDA];
  public const RUTA_FOTOS_OBSERVADAS = [Constants::RUTA_FOTO_CARNET_OBSERVADO, Constants::RUTA_DNI_ANVERSO_OBSERVADO, Constants::RUTA_DNI_REVERSO_OBSERVADO];

  //ESTADOS DE POSTULANTES
  public const ESTADO_INSCRITO = '1';
  public const ESTADO_OBSERVADO = '2';
  public const ESTADO_ENVIO_OBSERVADO = '3';
  public const ESTADO_VALIDO = '4';
  public const ESTADO_CARNET_IMPRESO_PENDIENTE = '5';
  public const ESTADO_HUELLA_DIGITAL = '6';
  public const ESTADO_CARNET_ENTREGADO = '7';
  public const ESTADO_INSCRIPCION_ANULADA = '8';

  //TIPOS DE DOCUMENTO DEPOSITANTE
  public const TIPO_DOCUMENTO_DNI = '1';
  public const TIPO_DOCUMENTO_CARNET_EXTRANJERIA = '9';

  //TIPO DE MODALIDAD
  public const MODALIDAD_DOS_PRIMEROS_PUESTOS = '2';
  public const MODALIDAD_QUINTO_SECUNDARIA = '9';

  public const ESTADOS_VALIDOS_POSTULANTE = [Constants::ESTADO_VALIDO, Constants::ESTADO_CARNET_IMPRESO_PENDIENTE];
  public const ESTADOS_VALIDOS_POSTULANTE_ADMISION = [Constants::ESTADO_VALIDO, Constants::ESTADO_CARNET_IMPRESO_PENDIENTE, Constants::ESTADO_HUELLA_DIGITAL, Constants::ESTADO_CARNET_ENTREGADO];
  public const ESTADOS_OBSERVADOS_POSTULANTE = [Constants::ESTADO_OBSERVADO, Constants::ESTADO_ENVIO_OBSERVADO];

  //ESTADOS TITULADO TRASLADO EXTERNO NAC. E INTERNAC.
  public const ESTADO_TITULADO_TRASLADO = ['3', '4'];

  // DISCO DE STORAGE
  public const DISK_STORAGE = 'public';

  //EXTRANGERO
  public const DISTRITO_OTROS_ID = 1868;

  //RUTAS DE FOTOS ADMISION
  public const RUTA_FOTO_ANTIGUA_QR = 'temp/qr-antiguo/';
  public const CARPETA_ARCHIVOS_VALIDOS = 'archivos_validos/';
  public const CARPETA_ARCHIVOS_OBSERVADOS = 'archivos_observados/';
  public const CARPETA_FOTO_CARNET = 'foto_carnet/';
  public const CARPETA_DNI_ANVERSO = 'dni_anverso/';
  public const CARPETA_DNI_REVERSO = 'dni_reverso/';

  // MODALIDAD UNIVERSIDAD
  public const MODALIDAD_TITULADOS_TRASLADO = [4, 5];

  //CODIGOS DE CONCEPTO ADMISION
  public const NUMERO_CONCEPTO_ADMISION = ['345', '346', '997', '998', '999'];
}
