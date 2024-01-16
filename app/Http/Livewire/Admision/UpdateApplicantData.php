<?php

namespace App\Http\Livewire\Admision;

use Livewire\Component;
use App\Http\Requests\View\UpdateApplicantWithProgramModality;
use App\Http\Requests\View\Message\UpdateApplicant;
use App\Services\DataService;
use \App\Models\Postulante;
use App\Utils\UtilFunction;
use \App\Models\Distrito;
use App\Models\Modalidad;
use App\Models\Provincia;
use App\Models\Colegio;
use Illuminate\Support\Str;
use App\Models\Banco;

class UpdateApplicantData extends Component
{
    protected $listeners = ['updatePostulante'];
    public $searchByApplicantDni = '';
    public $applicant;
    public $departments;
    public $universities = null;
    public $provincesBirth;
    public $districtsBirth;
    public $provincesReside;
    public $districtsReside;
    public $selectedDepartmentBirth = "";
    public $selectedProvinceBirth = "";
    public $selectedDepartmentReside = "";
    public $selectedProvinceReside = "";
    public $academicPrograms;
    public $modalities;
    public $searchSchoolName = '';
    public $schools = "";
    public $schoolLocation = '';
    public $programaAcademicoId = 0;
    public $idModality = 0;
    public $importe = 0;
    public $showAlert = false;
    public $showSchools = false;
    public $programChange = false;
    public $modalityChange = false;
    public $montoModalidad = 0;
    protected $messages = UpdateApplicant::MESSAGES_ERROR;

    protected function rules()
    {
        $request = new UpdateApplicantWithProgramModality;
        return $request->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount(DataService $dataService)
    {
        $this->departments = $dataService->getDepartaments();
        $this->districtsReside = $dataService->getDistricts();
        $this->provincesReside = $dataService->getProvinces();
        $this->districtsBirth = $dataService->getDistricts();
        $this->provincesBirth = $dataService->getProvinces();
        $this->academicPrograms = $dataService->getAcademicsProgram();
        $this->modalities = $dataService->getModalities();
    }

    public function render()
    {
        if ($this->showSchools) {
            $this->schools = Colegio::where('nombre', 'like', '%' . $this->searchSchoolName . '%')
                ->where('tipo', $this->applicant->colegio->tipo)
                ->get();
            if ($this->schools->isEmpty()) {
                session()->flash('null', 'Colegio no encontrado.');
            }
        }

        return view('livewire.admision.update-applicant-data');
    }

    public function refreshData()
    {
        $this->validate([
            'searchByApplicantDni' => 'required|numeric|regex:/^\d{8,9}$/|exists:tb_postulante,num_documento',
        ]);
        $this->applicant = Postulante::where('num_documento', $this->searchByApplicantDni)->first();
        $this->universities = UtilFunction::getUniversidadesByModalidad($this->applicant->modalidad_id);
        $this->programaAcademicoId = $this->applicant->programa_academico_id;
        $this->idModality = $this->applicant->modalidad_id;
        $this->importe = Banco::getImporteByNumDoc($this->applicant->num_voucher);
        $this->getLocationIdByDistrict('Birth', $this->applicant->distrito_nac_id);
        $this->getLocationIdByDistrict('Reside', $this->applicant->distrito_res_id);
        $this->getDepartmentProvince('Birth', $this->selectedDepartmentBirth, $this->selectedProvinceBirth);
        $this->getDepartmentProvince('Reside', $this->selectedDepartmentReside, $this->selectedProvinceReside);
        $this->updateSchool($this->applicant->colegio_id);
        $this->reset(['programChange', 'modalityChange']);
    }

    private function getLocationIdByDistrict($tipo, $idDistrito)
    {
        $distrito = Distrito::find($idDistrito)->provincia;
        $this->{'selectedDepartment' . $tipo} = $distrito->departamento->id;
        $this->{'selectedProvince' . $tipo} = $distrito->id;
    }

    private function getDepartmentProvince($tipo, $departamentoId, $provinciaId)
    {
        $this->{'provinces' . $tipo} = Provincia::where('departamento_id', $departamentoId)->get();
        $this->{'districts' . $tipo} = Distrito::where('provincia_id', $provinciaId)->get();
    }

    public function changePlaceBirth($action, $idlocation)
    {
        if ($action == 'DEPARTMENT') {
            $this->reset('selectedProvinceBirth');
            $this->applicant->distrito_nac_id = null;
            $this->getDepartmentProvince('Birth', $idlocation, $this->selectedProvinceBirth);
        } elseif ($action == 'PROVINCE') {
            $this->applicant->distrito_nac_id =  null;
            $this->getDepartmentProvince('Birth', $this->selectedDepartmentBirth, $idlocation);
        }
        $this->validateOnly('applicant.distrito_nac_id');
    }

    public function changePlaceReside($action, $idlocation)
    {
        if ($action == 'DEPARTMENT') {
            $this->reset('selectedProvinceReside');
            $this->applicant->distrito_res_id = null;
            $this->getDepartmentProvince('Reside', $idlocation, $this->selectedProvinceReside);
        } elseif ($action == 'PROVINCE') {
            $this->applicant->distrito_res_id = null;
            $this->getDepartmentProvince('Reside', $this->selectedDepartmentReside, $idlocation);
        }
        $this->validateOnly('applicant.distrito_res_id');
    }

    public function changesModalityOrProgram($attribute, $value)
    {
        if ($attribute == 'PROGRAM') {
            $this->programChange = $this->programaAcademicoId != $value;
        }
        if ($attribute == 'MODALITY') {
            $this->modalityChange = $this->idModality != $value;
            $this->validateImporteByModality($value);
        }
    }

    public function updateSchool($idColegio)
    {
        $this->searchSchoolName = Colegio::find($idColegio)->nombre;
        $this->schoolLocation = UtilFunction::getSchoolLocation($idColegio);
        $this->applicant->colegio_id = $idColegio;
        $this->showSchools = false;
    }

    public function updatePostulante()
    {
        $validatedData = $this->validate();

        UtilFunction::moveQrImageByDni('QR' . md5($this->applicant->num_documento));
        $this->applicant->nombres = trim(Str::upper($this->applicant->nombres));
        $this->applicant->ap_paterno = trim(Str::upper($this->applicant->ap_paterno));
        $this->applicant->ap_materno = trim(Str::upper($this->applicant->ap_materno));
        $this->applicant->update($validatedData);
        UtilFunction::updateQr($this->applicant->id);

        return redirect()->route('home.modifyApplicant')->with('success', 'Datos del postulante actualizados correctamente');
    }

    public function validateImporteByModality($idModalidad)
    {
        $modalidad = Modalidad::find($idModalidad);
        $this->montoModalidad = $this->applicant->colegio->tipo == 1 ? $modalidad->monto_nacional : $modalidad->monto_particular;

        if ($this->importe < $this->montoModalidad) {
            $this->applicant->modalidad_id = $this->idModality;
            $this->reset('modalityChange');
            session()->flash('warning');
        }
    }
}
