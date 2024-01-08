<?php

namespace App\Http\Requests\View\Message;

class ValidatePayment
{
  public const MESSAGES_ERROR = [
    'numDocument.required' => 'dni es requerido',
    'numDocument.numeric' => 'campo dni debe ser numérico',
    'numDocument.regex' => 'este campo debe tener 8 o 9 dígitos',
    'voucherNumber.required' => 'voucher es requerido',
    'voucherNumber.numeric' => 'campo número de voucher debe ser numérico',
    'voucherNumber.digits' => 'campo número de voucher debe tener 7 dígitos',
    'voucherNumber.exists' => 'número de voucher no encontrado',
    'agencyNumber.required' => 'agencia es requerido',
    'agencyNumber.digits' => 'campo de agencia debe tener 4 digitos',
    'agencyNumber.numeric' => 'campo número de agencia debe ser numérico',
    'agencyNumber.exists' => 'número de agencia no encontrado',
    'payDay.required' => 'fecha de pago es requerido',
    'payDay.date' => 'campo fecha de pago debe ser una fecha',
    'modalityId.required' => 'modalidad es requerido',
    'modalityId.numeric' => 'campo modalidad debe ser numérico',
    'typeSchoolId.required' => 'tipo de colegio es requerido',
    'typeSchoolId.numeric' => 'campo tipo de colegio debe ser numérico',
  ];
}
