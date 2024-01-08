<?php

namespace App\Http\Requests\View\Message;

class CreateUser
{
  public const MESSAGES_ERROR = [
    'name.required' => 'campo nombre no puede ser vacío',
    'name.min' => 'mínimo 3 caracteres.',
    'lastname.required' => 'campo apellido no puede ser vacío',
    'lastname.min' => 'mínimo 3 caracteres.',
    'user.required' => 'campo usuario no puede ser vacío',
    'user.min' => 'mínimo 3 caracteres.',
    'user.unique' => 'usuario ya existe.',
    'password.required' => 'campo contraseña no puede ser vacío',
    'password.min' => 'mínimo 6 caracteres.',
  ];
}
