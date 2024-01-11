<?php

namespace App\Http\Livewire\Admision\Postulante;

use Livewire\Component;
use App\Http\Requests\View\Message\UpdateApoderadoMessage;
use App\Http\Requests\View\UpdateApoderadoRequest;
use \App\Models\Postulante;
use App\Models\Banco;

class UpdateApoderado extends Component
{
    public $applicant;
    public $searchByApplicantDni = '';
    public $importe = 0;
    protected $messages = UpdateApoderadoMessage::MESSAGES_ERROR;

    protected function rules()
    {
        $request = new UpdateApoderadoRequest;
        return $request->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.admision.postulante.update-apoderado');
    }

    public function refreshData()
    {
        $this->validate([
            'searchByApplicantDni' => 'required|numeric|regex:/^\d{8,9}$/|exists:tb_postulante,num_documento',
        ]);
        $this->applicant = Postulante::where('num_documento', $this->searchByApplicantDni)->first();
        $this->importe = Banco::getImporteByNumDoc($this->applicant->num_voucher);
    }
}
