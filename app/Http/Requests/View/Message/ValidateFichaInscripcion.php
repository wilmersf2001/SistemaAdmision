<?php

namespace App\Http\Requests\View\Message;

class ValidateFichaInscripcion
{
  public const MESSAGES_ERROR = [
    'num_documento.required' => 'El campo DNI es obligatorio.',
    'num_documento.numeric' => 'El campo DNI debe ser numérico.',
    'num_documento.regex' => 'El campo DNI debe tener 8 o 9 dígitos.',
    'num_voucher.required' => 'El campo N° de voucher es obligatorio.',
    'num_voucher.numeric' => 'El campo N° de voucher debe ser numérico.',
    'num_voucher.digits' => 'El campo N° de voucher debe tener 7 dígitos.',
  ];
}
