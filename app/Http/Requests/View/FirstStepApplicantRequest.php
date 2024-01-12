<?php

namespace App\Http\Requests\View;

class FirstStepApplicantRequest
{
  public const FIRST_STEP_VALIDATE = [
    'applicant.nombres' => 'required',
    'applicant.ap_paterno' => 'required',
    'applicant.ap_materno' => 'required',
    'applicant.fecha_nacimiento' => 'required|date|before:2010-01-01',
    'applicant.sexo_id' => 'required',
    'applicant.distrito_nac_id' => 'required',
    'applicant.pais_id' => 'required_if:tipo_documento,9',
    'applicant.distrito_res_id' => 'required',
    'applicant.tipo_direccion_id' => 'required',
    'applicant.direccion' => 'required',
    'applicant.telefono' => 'required|numeric|digits:9',
    'applicant.telefono_ap' => 'required|numeric|digits:9',
    'applicant.correo' => 'required|email',
  ];
}
