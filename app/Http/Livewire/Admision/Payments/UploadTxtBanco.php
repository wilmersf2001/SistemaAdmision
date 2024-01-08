<?php

namespace App\Http\Livewire\Admision\Payments;

use Livewire\Component;
use Livewire\WithFileUploads;

class UploadTxtBanco extends Component
{
    use WithFileUploads;

    public $filetxt;
    protected $messages = [
        'filetxt.required' => 'El archivo es obligatorio',
        'filetxt.mimes' => 'El archivo debe ser de tipo .txt'
    ];
    protected $rules = [
        'filetxt' => 'required|file|mimes:txt'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.admision.payments.upload-txt-banco');
    }
}
