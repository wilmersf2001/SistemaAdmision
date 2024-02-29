<?php

namespace App\Http\Livewire\Inscripcion;

use App\Models\Postulante;
use App\Utils\UtilFunction;
use Livewire\Component;
use App\Utils\Constants;

class SummaryTemplate extends Component
{
  public Postulante $applicant;
  public $nameSexo;
  public $formattedDateNac;
  public $distritNac;
  public $districtAddress;
  public $typeAddress;
  public $school;
  public $sede;
  public $programAcademic;
  public $modality;
  public $tipo_documento;
  public $university;
  public $isAgeMinor;

  public function mount(Postulante $applicant, int $tipo_documento)
  {
    $this->applicant = $applicant;
    $this->tipo_documento = $tipo_documento;
    if (in_array($this->applicant->modalidad_id, Constants::ESTADO_TITULADO_TRASLADO)) {
      $this->university = $this->applicant->universidad->nombre;
    }
    $this->isAgeMinor = UtilFunction::isAgeMinor($this->applicant->fecha_nacimiento);
  }
  public function render()
  {
    $this->formattedDateNac = UtilFunction::formattedDate($this->applicant->fecha_nacimiento);
    $this->nameSexo = $this->applicant->sexo->descripcion;
    $this->distritNac = $this->applicant->distritoNac->nombre;
    $this->districtAddress = $this->applicant->distritoRes->nombre;
    $this->typeAddress = $this->applicant->tipodireccion->descripcion;
    $this->school = $this->applicant->colegio;
    $this->sede = $this->applicant->sede->nombre;
    $this->programAcademic = $this->applicant->programaAcademico->nombre;
    $this->modality = $this->applicant->modalidad->descripcion;

    return view('livewire.inscripcion.summary-template');
  }
}
