<?php

namespace App\Http\Livewire\Inscripcion;

use Livewire\Component;
use App\Http\Requests\View\Message\ValidatePayment;
use App\Models\Modalidad;

class Pay extends Component
{
  public $numDocument = '';
  public $voucherNumber = '';
  public $agencyNumber = '';
  public $modalities;
  public $payDay;
  public $modalityId;
  public $typeSchoolId;

  protected $messages = ValidatePayment::MESSAGES_ERROR;

  protected $rules = [
    'numDocument' => 'required|numeric|regex:/^\d{8,9}$/',
    'voucherNumber' => 'required|numeric|digits:7',
    'agencyNumber' => 'required|numeric|digits:4',
    'payDay' => 'required|date',
    'modalityId' => 'required|numeric',
    'typeSchoolId' => 'required|numeric',
  ];

  public function updated($propertyName)
  {
    $this->validateOnly($propertyName);
  }

  public function mount()
  {
    $this->modalities = Modalidad::where('estado', 1)->get();
  }

  public function render()
  {
    return view('livewire.inscripcion.pay');
  }
}
