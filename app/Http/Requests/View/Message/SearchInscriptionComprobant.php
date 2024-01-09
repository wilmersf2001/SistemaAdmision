<?php

namespace App\Http\Requests\View\Message;

class SearchInscriptionComprobant
{
  public const MESSAGES_ERROR = [
    'dniApplicant.required' => 'El DNI es obligatorio.',
    'dniApplicant.numeric' => 'Solo se aceptan caracteres numéricos.',
    'dniApplicant.regex' => 'El DNI debe tener 8 o 9 dígitos.',
    'dniApplicant.exists' => 'El DNI no se encuentra registrado.',
  ];
}
