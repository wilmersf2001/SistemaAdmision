<?php

namespace App\Http\Requests\View\Message;

class ProgramModality
{
  public const MESSAGES_ERROR = [
    'applicantDni.required' => 'El campo DNI es obligatorio.',
    'applicantDni.numeric' => 'El campo DNI debe ser numérico.',
    'applicantDni.digits' => 'El campo DNI debe tener 8 dígitos.',
    'modifiedFieldOne.required' => 'El campo es obligatorio.',
    'modifiedFieldTwo.required' => 'El campo es obligatorio.',
    'documentNumberOne.required' => 'El campo es obligatorio.',
    'documentNumberTwo.required' => 'El campo es obligatorio.',
    'modalityId.required' => 'El campo es obligatorio.',
    'sedeId.required' => 'El campo es obligatorio.',
  ];
}
