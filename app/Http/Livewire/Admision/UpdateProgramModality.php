<?php

namespace App\Http\Livewire\Admision;

use Livewire\Component;
use App\Http\Requests\View\Message\ProgramModality;
use App\Http\Requests\View\UpdateProgramModalityRequest;
use App\Models\ActualizarModalidadPrograma;
use App\Models\ProgramaAcademico;
use App\Models\Postulante;
use App\Models\Modalidad;

class UpdateProgramModality extends Component
{
    public $showModal = false;
    public $modifyTwoFields = false;
    public $applicantDni = '';
    public $modalityId = '';
    public $programId = '';
    public $documentNumberOne = '';
    public $documentNumberTwo = '';
    public $modifiedFieldOne = '';
    public $modifiedFieldTwo = '';
    public $previousFieldValueOne = '';
    public $previousFieldValueTwo = '';
    protected $messages = ProgramModality::MESSAGES_ERROR;

    protected function rules()
    {
        $request = new UpdateProgramModalityRequest;
        return $request->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        if ($this->modifyTwoFields) {
            $this->modifiedFieldOne = 'Modalidad';
            $this->modifiedFieldTwo = 'Programa Académico';
            $this->previousFieldValueOne = Modalidad::find($this->modalityId)->descripcion;
            $this->previousFieldValueTwo = ProgramaAcademico::find($this->programId)->nombre;
        } else {
            if (Postulante::where('num_documento', $this->applicantDni)->first()->modalidad_id == $this->modalityId) {
                $this->modifiedFieldOne = 'Programa Académico';
                $this->previousFieldValueOne = ProgramaAcademico::find($this->programId)->nombre;
            } else {
                $this->modifiedFieldOne = 'Modalidad';
                $this->previousFieldValueOne = Modalidad::find($this->modalityId)->descripcion;
            }
        }

        return view('livewire.admision.update-program-modality');
    }

    private function validateAndCreateUpdate($modifiedField, $documentNumber, $previousFieldValue)
    {
        $this->validate([
            'applicantDni' => 'required|numeric|digits:8',
            $modifiedField => 'required',
            $documentNumber => 'required',
        ]);

        ActualizarModalidadPrograma::create([
            'dni_postulante' => $this->applicantDni,
            'numero_documento' => $this->$documentNumber,
            'campo_modificado' => $this->$modifiedField,
            'valor_anterior' => $this->$previousFieldValue,
        ]);
    }
    public function store()
    {
        if ($this->modifyTwoFields) {
            $this->validateAndCreateUpdate('modifiedFieldOne', 'documentNumberOne', 'previousFieldValueOne');
            $this->validateAndCreateUpdate('modifiedFieldTwo', 'documentNumberTwo', 'previousFieldValueTwo');
        } else {
            $this->validateAndCreateUpdate('modifiedFieldOne', 'documentNumberOne', 'previousFieldValueOne');
        }

        $this->emit('updatePostulante');
    }
}
