<?php

namespace App\Http\Livewire\Admision\UserReniec;

use Livewire\Component;

class Update extends Component
{
    public $user;
    public $oldPassword;
    public $newPassword;
    protected $messages = [
        'oldPassword.required' => 'La contraseña anterior es requerida',
        'newPassword.required' => 'La nueva contraseña es requerida',
        'newPassword.min' => 'Este campo debe tener al menos 8 caracteres',
    ];

    protected $rules = [
        'oldPassword' => 'required',
        'newPassword' => 'required|string|min:8',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.admision.user-reniec.update');
    }
}
