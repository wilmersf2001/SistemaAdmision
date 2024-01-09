<?php

namespace App\Http\Livewire\Admision;

use Livewire\Component;
use App\Models\Postulante;
use App\Utils\Constants;
use App\Http\Requests\View\Message\SearchInscriptionComprobant;

class InscriptionComprobant extends Component
{
    public $dniApplicant;
    public $applicant;
    public $applicantExists = false;
    public $validApplicantExists = false;
    protected $messages = SearchInscriptionComprobant::MESSAGES_ERROR;

    protected $rules = [
        'dniApplicant' => 'required|numeric|regex:/^\d{8,9}$/|exists:tb_postulante,num_documento',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.admision.inscription-comprobant');
    }

    public function searchByDni()
    {
        $this->validate();
        $this->applicantExists = Postulante::where('num_documento', $this->dniApplicant)->exists();
        $this->validApplicantExists = Postulante::where('num_documento', $this->dniApplicant)->whereIn('estado_postulante_id', Constants::ESTADOS_VALIDOS_POSTULANTE)->exists();
        $this->applicant = Postulante::where('num_documento', $this->dniApplicant)->first();
    }
}
