<?php

namespace App\Http\Livewire\Admision\VacancyDistribution;

use App\Models\DistribucionVacante;
use Livewire\Component;
use App\Models\Modalidad;
use App\Models\ProgramaAcademico;
use Livewire\WithPagination;

class VacancyDistribution extends Component
{
    use WithPagination;

    public $modalities;
    public $academicPrograms;
    public $academicProgramId;
    public $searchProgramAcademic;
    public $academicProgramModificationId;
    public $vacantQuantity = [];
    protected $messages = [
        'vacantQuantity.*.required' => 'El campo de vacantes no puede ser vacío',
        'vacantQuantity.*.integer' => 'El número de vacantes debe ser un número entero',
        'vacantQuantity.*.gte' => 'El número de vacantes debe ser mayor o igual a 0',
    ];

    protected $rules = [
        'vacantQuantity.*' => 'required|integer|gte:0',
    ];

    public function mount()
    {
        $this->modalities = Modalidad::where('estado', 1)->get();
        $this->academicPrograms = ProgramaAcademico::where('estado', 1)->get();
    }

    public function render()
    {
        $academicProgramsByModality = null;

        if ($this->academicProgramId) {
            $query = DistribucionVacante::where('modalidad_id', $this->academicProgramId);

            if ($this->searchProgramAcademic) {
                $academicPrograms = ProgramaAcademico::where('nombre', 'like', '%' . $this->searchProgramAcademic . '%')->pluck('id');
                $query->whereIn('programa_academico_id', $academicPrograms);
            }

            $academicProgramsByModality = $query->paginate(10);
        }

        return view('livewire.admision.vacancy-distribution.vacancy-distribution', compact('academicProgramsByModality'));
    }

    public function modifyVacancy($academicProgramId)
    {
        $this->academicProgramModificationId = $academicProgramId;
        $this->vacantQuantity[$academicProgramId] = DistribucionVacante::find($academicProgramId)->vacantes;
    }

    public function updateVacancy($academicProgramId)
    {
        $this->validate();
        DistribucionVacante::find($academicProgramId)->update(['vacantes' => $this->vacantQuantity[$academicProgramId]]);
        $this->reset(['academicProgramModificationId', 'vacantQuantity']);
    }

    public function getProgramByModality($modalityId)
    {
        $this->academicProgramId = $modalityId;
        $this->reset(['searchProgramAcademic']);
    }
}
