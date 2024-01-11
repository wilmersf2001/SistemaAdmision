<?php

namespace App\Http\Requests\View\Message;

class UpdateUser
{
  public const MESSAGES_ERROR = [
    'user.nombre.required' => 'El campo nombre es obligatorio',
    'user.nombre.min' => 'Al menos 3 caracteres',
    'user.apellido.required' => 'El campo apellido es obligatorio',
    'user.apellido.min' => 'Al menos 3 caracteres',
    'user.usuario.required' => 'El campo usuario es obligatorio',
    'user.usuario.min' => 'Al menos 3 caracteres',
    'newPassword.required' => 'Este campo es obligatorio',
    'newPassword.min' => 'Al menos 6 caracteres',
  ];
}
