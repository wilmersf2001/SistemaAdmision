<?php

namespace App\Http\Requests\View;

class StepThreeApplicantRequest
{
  public const SETEP_THREE_VALIDATE = [
    'profilePhoto' => 'required|mimes:jpeg|max:1024',
    'reverseDniPhoto' => 'required|mimes:jpeg|max:1024',
    'frontDniPhoto' => 'required|mimes:jpeg|max:1024',
  ];
}
