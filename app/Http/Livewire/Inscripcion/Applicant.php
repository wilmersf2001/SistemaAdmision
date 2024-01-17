<?php

namespace App\Http\Livewire\Inscripcion;

use App\Http\Requests\View\StoreApplicantRequest;
use App\Http\Requests\View\FirstStepApplicantRequest;
use App\Http\Requests\View\StepTwoApplicantRequest;
use App\Http\Requests\View\StepThreeApplicantRequest;
use App\Http\Requests\View\Message\ValidateApplicant;
use App\Services\ApiReniecService;
use App\Models\DistribucionVacante;
use App\Services\FormDataService;
use App\Services\LocationService;
use App\Utils\UtilFunction;
use Livewire\WithFileUploads;
use App\Models\Postulante;
use Livewire\Component;
use App\Models\Departamento;
use App\Models\Provincia;
use App\Models\Distrito;
use App\Models\Banco;
use App\Models\Colegio;
use App\Models\Proceso;
use App\Utils\Constants;

class Applicant extends Component
{
  use WithFileUploads;

  public Postulante $applicant;
  public Banco $bank;
  public $departaments;
  public $provincesBirth;
  public $districtsBirth;
  public $selectedProvinceBirthId;
  public $provincesReside;
  public $districtsReside;
  public $countries;
  public $selectedProvinceResideId;
  public $provincesOriginSchool;
  public $districtsOriginSchool;
  public $selectedDepartamentOriginSchoolId;
  public $selectedProvinceOriginSchoolId;
  public $selectedDistrictOriginSchoolId;
  public $adressType;
  public $generos;
  public $schools;
  public $sedes;
  public $modalities;
  public $academicPrograms;
  public $universities;
  public $searchSchoolName;
  public $typeSchool;
  public $profilePhoto;
  public $reverseDniPhoto;
  public $frontDniPhoto;
  public $formattedToday;
  public $currentStep = 1;
  public $minimumYear = 1940;
  public $accordance = false;
  public $showSchools = false;
  public $numberProcess = 0;
  public $isAgeMinor = false;
  public $disableInputApplicant = 0;
  public $disableInputApoderado = 0;
  protected $messages = ValidateApplicant::MESSAGES_ERROR;

  protected function rules()
  {
    $request = new StoreApplicantRequest();
    return $request->rules();
  }

  public function updated($propertyName)
  {
    $this->validateOnly($propertyName);
  }

  public function mount(Postulante $responseApiReniec, Banco $bank, $typeSchool, LocationService $locationService, FormDataService $formDataService)
  {
    $this->applicant = $responseApiReniec;
    $this->bank = $bank;
    $this->departaments =  $locationService->getDepartments();
    $this->countries = $locationService->getCountries();
    $this->adressType = $formDataService->getAdressType();
    $this->generos = $formDataService->getGeneros();
    $this->sedes = $formDataService->getSedes();
    $this->modalities = $formDataService->getModalities();
    $this->academicPrograms = DistribucionVacante::getProgramasAcademicosByModalidad($this->applicant->modalidad_id);
    $this->formattedToday = UtilFunction::getDateToday();
    $this->typeSchool = $typeSchool;
    $this->disableInputApplicant = $this->applicant->nombres != null ? 1 : 0;
    $this->minimumYear = UtilFunction::getMinimumYearByModalidad($this->applicant->modalidad_id);
    $this->universities = UtilFunction::getUniversitiesByModality($this->applicant->modalidad_id, $this->typeSchool, $formDataService);
    $this->numberProcess = Proceso::getProcessNumber();
    if ($this->bank->tipo_doc_depo == Constants::TIPO_DOCUMENTO_CARNET_EXTRANJERIA) {
      $this->searchSchoolName = $typeSchool == 1 ? "OTROS COLEGIOS NACIONALES" : "OTROS COLEGIOS PARTICULARES";
      $this->LocationOutsideCountry(26);
    }
  }

  public function render()
  {
    $this->searchSchools();
    if ($this->applicant->fecha_nacimiento && !$this->getErrorBag()->has('applicant.fecha_nacimiento')) {
      $this->isAgeMinor = UtilFunction::isAgeMinor($this->applicant->fecha_nacimiento);
      if (!$this->isAgeMinor) {
        $this->applicant->num_documento_apoderado = null;
        $this->resetDataApoderado();
      }
    }

    return view('livewire.inscripcion.applicant');
  }

  public function getApoderadoDataByDni(ApiReniecService $apiReniecService)
  {
    $this->validateOnly('applicant.num_documento_apoderado');
    $apoderado = $apiReniecService->getApoderadoDataByDni($this->applicant->num_documento_apoderado);
    if (count($apoderado) > 0) {
      $this->applicant->nombres_apoderado = $apoderado['nombres'];
      $this->applicant->ap_paterno_apoderado = $apoderado['apellidoPaterno'];
      $this->applicant->ap_materno_apoderado = $apoderado['apellidoMaterno'];
      $this->applicant->num_documento_apoderado = $apoderado['dni'];
      $this->disableInputApoderado = 1;
      $this->resetErrorBag('applicant.nombres_apoderado');
      $this->resetErrorBag('applicant.ap_paterno_apoderado');
      $this->resetErrorBag('applicant.ap_materno_apoderado');
    } else {
      $this->resetDataApoderado();
    }
  }

  private function resetDataApoderado()
  {
    $this->applicant->nombres_apoderado = null;
    $this->applicant->ap_paterno_apoderado = null;
    $this->applicant->ap_materno_apoderado = null;
    $this->disableInputApoderado = 0;
  }

  private function searchSchools()
  {
    if ($this->selectedDistrictOriginSchoolId) {
      $ubigeoDistrito = Distrito::find($this->selectedDistrictOriginSchoolId)->ubigeo;

      $query = Colegio::where('nombre', 'like', '%' . $this->searchSchoolName . '%')
        ->where('ubigeo', $ubigeoDistrito);

      if (!$this->isModalidadTituladoTraslado()) {
        $query->where('tipo', $this->typeSchool);
      }

      $this->schools = $query->get();
      $this->setFlashIfSchoolsNotFound();
    } else {
      $this->setFlashIfDistrictNotSelected();
    }
  }

  private function isModalidadTituladoTraslado()
  {
    return in_array($this->applicant->modalidad_id, Constants::ESTADO_TITULADO_TRASLADO);
  }

  private function setFlashIfSchoolsNotFound()
  {
    if ($this->schools->isEmpty() && $this->searchSchoolName != '') {
      session()->flash('null', 'Colegio no encontrado.');
    }
  }

  private function setFlashIfDistrictNotSelected()
  {
    if (!$this->selectedDistrictOriginSchoolId && $this->searchSchoolName != null) {
      session()->flash('null', 'Seleccione el distrito de procedencia.');
    }
  }

  public function changePlaceBirth(string $action, int $idlocation)
  {
    if ($action == 'DEPARTMENT') {
      $this->provincesBirth = Departamento::find($idlocation)->provincias()->get();
      $this->reset('selectedProvinceBirthId');
    } elseif ($action == 'PROVINCE') {
      $this->districtsBirth = Provincia::find($idlocation)->distritos()->get();
    }
    $this->applicant->distrito_nac_id = null;
  }

  public function changePlaceReside(string $action, int $idlocation)
  {
    if ($action == 'DEPARTMENT') {
      $this->provincesReside = Departamento::find($idlocation)->provincias()->get();
      $this->reset('selectedProvinceResideId');
    } elseif ($action == 'PROVINCE') {
      $this->districtsReside = Provincia::find($idlocation)->distritos()->get();
    }
    $this->applicant->distrito_res_id = null;
  }

  public function changePlaceOriginSchool(string $action, int $idlocation)
  {
    if ($action == 'DEPARTMENT') {
      $this->provincesOriginSchool = Departamento::find($idlocation)->provincias()->get();
      $this->reset(['selectedProvinceOriginSchoolId']);
    } elseif ($action == 'PROVINCE') {
      $this->districtsOriginSchool = Provincia::find($idlocation)->distritos()->get();
    }
    $this->reset(['searchSchoolName', 'selectedDistrictOriginSchoolId']);
    $this->applicant->colegio_id = null;
  }

  public function resetSchool()
  {
    $this->reset(['searchSchoolName']);
    $this->applicant->colegio_id = null;
  }

  public function LocationOutsideCountry(int $idlocation)
  {
    $this->selectedDepartamentOriginSchoolId = $idlocation;
    $this->provincesOriginSchool = Departamento::find($idlocation)->provincias()->get();
    $provinceOriginSchoolId = $this->provincesOriginSchool->first()->id;
    $this->districtsOriginSchool = Provincia::find($provinceOriginSchoolId)->distritos()->get();
    $this->selectedProvinceOriginSchoolId = $this->provincesOriginSchool->first()->id;
    $this->selectedDistrictOriginSchoolId = $this->districtsOriginSchool->first()->id;
  }

  public function updateSchool(int $idSchool)
  {
    $school = Colegio::find($idSchool);
    $this->searchSchoolName = $school->nombre;
    $this->applicant->colegio_id = $school->id;
    $this->showSchools = false;
  }

  public function nextStep()
  {
    if ($this->currentStep == 1) {
      $rules = FirstStepApplicantRequest::FIRST_STEP_VALIDATE;
      if ($this->bank->tipo_doc_depo == Constants::TIPO_DOCUMENTO_CARNET_EXTRANJERIA) {
        $rules['applicant.pais_id'] = 'required|numeric';
      }
      if ($this->isAgeMinor) {
        $rules['applicant.num_documento_apoderado'] = 'required|numeric|regex:/^\d{8,9}$/';
        $rules['applicant.nombres_apoderado'] = 'required';
        $rules['applicant.ap_paterno_apoderado'] = 'required';
        $rules['applicant.ap_materno_apoderado'] = 'required';
      }
      $this->validate($rules);
    } elseif ($this->currentStep == 2) {
      $rules = StepTwoApplicantRequest::SETEP_TWO_VALIDATE;
      if (in_array($this->applicant->modalidad_id, Constants::ESTADO_TITULADO_TRASLADO)) {
        $rules['applicant.universidad_id'] = 'required|numeric';
      }
      $this->validate($rules);
    } elseif ($this->currentStep == 3) {
      $this->validate(StepThreeApplicantRequest::SETEP_THREE_VALIDATE);
    }
    $this->currentStep++;
  }

  public function previousStep()
  {
    $this->reset(['profilePhoto', 'reverseDniPhoto', 'frontDniPhoto']);
    $this->currentStep--;
  }
}
