<?php

namespace App\Http\Requests\View\Message;

class UpdateApoderadoMessage
{
  public const MESSAGES_ERROR = [
    'searchByApplicantDni.required' => 'El campo DNI es obligatorio.',
    'searchByApplicantDni.numeric' => 'El campo DNI debe ser un número.',
    'searchByApplicantDni.regex' => 'El campo DNI debe tener 8 o 9 dígitos.',
    'searchByApplicantDni.exists' => 'El numero de documento ingresado no existe.',
    'applicant.num_documento_apoderado.required' => 'El campo DNI del apoderado es obligatorio.',
    'applicant.num_documento_apoderado.numeric' => 'El campo DNI del apoderado debe ser un número.',
    'applicant.num_documento_apoderado.regex' => 'El campo DNI del apoderado debe tener 8 o 9 dígitos.',
    'applicant.nombres_apoderado.required' => 'El campo nombres del apoderado es obligatorio.',
    'applicant.ap_materno_apoderado.required' => 'El campo apellido materno del apoderado es obligatorio.',
    'applicant.ap_paterno_apoderado.required' => 'El campo apellido paterno del apoderado es obligatorio.',
  ];
}
