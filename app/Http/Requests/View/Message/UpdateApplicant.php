<?php

namespace App\Http\Requests\View\Message;

class UpdateApplicant
{
  public const MESSAGES_ERROR = [
    'searchByApplicantDni.required' => 'El campo DNI es obligatorio.',
    'searchByApplicantDni.numeric' => 'El campo DNI debe ser un número.',
    'searchByApplicantDni.regex' => 'El campo DNI debe tener 8 o 9 dígitos.',
    'searchByApplicantDni.exists' => 'El numero de documento ingresado no existe.',
    'applicant.nombres.required' => 'El campo nombres es obligatorio.',
    'applicant.ap_paterno.required' => 'El campo apellido paterno es obligatorio.',
    'applicant.ap_materno.required' => 'El campo apellido materno es obligatorio.',
    'applicant.fecha_nacimiento.required' => 'El campo fecha de nacimiento es obligatorio.',
    'applicant.fecha_nacimiento.date' => 'El campo fecha de nacimiento debe ser una fecha válida.',
    'applicant.num_documento.required' => 'El campo DNI es obligatorio.',
    'applicant.correo.required' => 'El campo correo es obligatorio.',
    'applicant.correo.email' => 'El campo correo debe ser un correo válido.',
    'applicant.telefono.required' => 'El campo teléfono es obligatorio.',
    'applicant.telefono.numeric' => 'El campo teléfono debe ser un número.',
    'applicant.telefono.digits' => 'El campo teléfono debe tener 9 dígitos.',
    'applicant.direccion.required' => 'El campo dirección es obligatorio.',
    'applicant.telefono_ap.required' => 'El campo teléfono de apoderado es obligatorio.',
    'applicant.telefono_ap.numeric' => 'El campo teléfono de apoderado debe ser un número.',
    'applicant.telefono_ap.digits' => 'El campo teléfono de apoderado debe tener 9 dígitos.',
    'applicant.distrito_nac_id.required' => 'El campo es obligatorio.',
    'applicant.distrito_nac_id.numeric' => 'El campo no puede ser vacío.',
    'applicant.distrito_res_id.required' => 'El campo es obligatorio.',
    'applicant.distrito_res_id.numeric' => 'El campo no puede ser vacío.',
    'applicant.modalidad_id.required' => 'El campo modalidad es obligatorio.',
    'applicant.escuela_id.required' => 'El campo programa académico es obligatorio.',
    'applicant.colegio_id.required' => 'El campo colegio es obligatorio.',
  ];
}
