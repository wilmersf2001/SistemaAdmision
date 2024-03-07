<?php

namespace App\Http\Livewire\Admision;

use Livewire\Component;
use App\Services\ApiReniecService;

class UpdateCredentials extends Component
{
    public $nuDni;
    public $credencialAnterior;
    public $credencialNueva;

    protected $rules = [
        'nuDni' => 'required|numeric|digits:8',
        'credencialAnterior' => 'required',
        'credencialNueva' => 'required',
    ];

    protected $messages = [
        'nuDni.required' => 'El campo DNI es obligatorio.',
        'nuDni.numeric' => 'El campo DNI debe ser numérico.',
        'nuDni.digits' => 'El campo DNI debe tener 8 dígitos.',
        'credencialAnterior.required' => 'El campo credencial anterior es obligatorio.',
        'credencialNueva.required' => 'El campo credencial nueva es obligatorio.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.admision.update-credentials');
    }
}
