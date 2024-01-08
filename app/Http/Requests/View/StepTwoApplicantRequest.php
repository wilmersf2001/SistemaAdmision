<?php

namespace App\Http\Requests\View;

class StepTwoApplicantRequest
{
  public const SETEP_TWO_VALIDATE = [
    'applicant.sede_id' => 'required|numeric',
    'applicant.programa_academico_id' => 'required|numeric',
    'applicant.num_veces_unprg' => 'required|numeric|integer|gte:0',
    'applicant.num_veces_otros' => 'required|numeric|integer|gte:0',
    'applicant.colegio_id' => 'required|numeric',
    'applicant.anno_egreso' => 'required|numeric|digits:4',
    'applicant.modalidad_id' => 'required|numeric',
    'typeSchool' => 'required|numeric',
    'selectedProvinceOriginSchoolId' => 'required|numeric',
    'selectedDistrictOriginSchoolId' => 'required|numeric',
  ];
}
