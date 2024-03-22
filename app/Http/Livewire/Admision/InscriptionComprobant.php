<?php

namespace App\Http\Livewire\Admision;

use Livewire\Component;
use App\Models\Postulante;
use App\Utils\Constants;
use App\Http\Requests\View\Message\SearchInscriptionComprobant;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

class InscriptionComprobant extends Component
{
    public $dniApplicant;
    public $encryptedDniApplicant;
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
        $user = Auth::user();
        return view('livewire.admision.inscription-comprobant', compact('user'));
    }

    public function searchByDni()
    {
        $this->validate();
        $this->applicantExists = Postulante::where('num_documento', $this->dniApplicant)->where('estado_postulante_id', '!=', Constants::ESTADO_INSCRIPCION_ANULADA)->exists();
        $this->validApplicantExists = Postulante::where('num_documento', $this->dniApplicant)->whereIn('estado_postulante_id', Constants::ESTADOS_VALIDOS_POSTULANTE_ADMISION)->exists();
        $this->applicant = Postulante::where('num_documento', $this->dniApplicant)
            ->where('estado_postulante_id', '!=', Constants::ESTADO_INSCRIPCION_ANULADA)
            ->first();
        $this->encryptedDniApplicant = Crypt::encryptString($this->dniApplicant);
    }
}
