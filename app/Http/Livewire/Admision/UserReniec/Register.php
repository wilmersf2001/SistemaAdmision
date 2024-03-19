<?php

namespace App\Http\Livewire\Admision\UserReniec;

use Livewire\Component;

class Register extends Component
{
    public $nuDniUsuario;
    public $nombresApellidos;
    public $password;
    protected $messages = [
        'nuDniUsuario.required' => 'El campo DNI es obligatorio',
        'nuDniUsuario.numeric' => 'El campo DNI debe ser numérico',
        'nuDniUsuario.digits' => 'El campo DNI debe tener 8 dígitos',
        'nombresApellidos.required' => 'Este campo es obligatorio',
        'password.required' => 'El campo Contraseña es obligatorio',
        'password.min' => 'Este campo debe tener al menos 8 caracteres',
    ];

    protected $rules = [
        'nuDniUsuario' => 'required|numeric|digits:8',
        'nombresApellidos' => 'required|string',
        'password' => 'required|string|min:8',
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.admision.user-reniec.register');
    }
}
