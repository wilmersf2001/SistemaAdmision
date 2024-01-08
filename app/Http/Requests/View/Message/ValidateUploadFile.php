<?php

namespace App\Http\Requests\View\Message;

class ValidateUploadFile
{
  public const MESSAGES_ERROR = [
    'profilePhoto.required' => 'La foto de perfil es requerida',
    'profilePhoto.image' => 'La foto de perfil debe ser una imagen',
    'profilePhoto.max' => 'La foto de perfil no debe pesar más de 1MB',
    'reverseDniPhoto.required' => 'La foto del reverso del DNI es requerida',
    'reverseDniPhoto.image' => 'La foto del reverso del DNI debe ser una imagen',
    'reverseDniPhoto.max' => 'La foto del reverso del DNI no debe pesar más de 1MB',
    'frontDniPhoto.required' => 'La foto del anverso del DNI es requerida',
    'frontDniPhoto.image' => 'La foto del anverso del DNI debe ser una imagen',
    'frontDniPhoto.max' => 'La foto del anverso del DNI no debe pesar más de 1MB',
  ];
}
