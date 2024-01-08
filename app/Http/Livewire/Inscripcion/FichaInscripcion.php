<?php

namespace App\Http\Livewire\Inscripcion;

use Livewire\Component;
use App\Http\Requests\View\Message\ValidateFichaInscripcion;

class FichaInscripcion extends Component
{
    public string $num_documento;
    public string $num_voucher;

    protected $messages = ValidateFichaInscripcion::MESSAGES_ERROR;

    protected $rules = [
        'num_documento' => 'required|numeric|regex:/^\d{8,9}$/',
        'num_voucher' => 'required|numeric|digits:7',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.inscripcion.ficha-inscripcion');
    }
}
