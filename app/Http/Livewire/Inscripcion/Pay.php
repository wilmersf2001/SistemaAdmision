<?php

namespace App\Http\Livewire\Inscripcion;

use Livewire\Component;
use App\Http\Requests\View\Message\ValidatePayment;
use App\Services\FormDataService;
use App\Utils\UtilFunction;
use Dflydev\DotAccessData\Util;

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

  public function mount(FormDataService $formDataService)
  {
    $this->modalities = $formDataService->getModalities();
  }

  public function render()
  {
    return view('livewire.inscripcion.pay');
  }
}
