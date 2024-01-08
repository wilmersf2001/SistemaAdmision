<?php

namespace App\Http\Livewire\Admision\VacancyDistribution;

use Livewire\Component;
use App\Models\Modalidad;
use App\Models\Sede;
use App\Models\ProgramaAcademico;
use App\Models\DistribucionVacante;

class AssingVacancies extends Component
{
    public $sedes;
    public $sedeId;
    public $modalities;
    public $modalidadId;
    public $academicPrograms;
    public $programaId;
    public $programAcademicWhitVacancies;
    protected $messages = [
        'sedeId.required' => 'El campo sede es requerido',
        'programaId.required' => 'El campo programa académico es requerido',
        'modalidadId.*.required' => 'El campo modalidad es requerido',
        'modalidadId.*.gte' => 'El campo modalidad debe ser mayor o igual a 0',
    ];

    protected $rules = [
        'sedeId' => 'required|numeric',
        'programaId' => 'required|numeric',
        'modalidadId.*' => 'present|numeric|gte:0',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->academicPrograms = ProgramaAcademico::where('estado', 1)->get();
        $this->modalities = Modalidad::where('estado', 1)->get();
        $this->sedes = Sede::where('estado', 1)->get();
    }

    public function render()
    {
        $this->programAcademicWhitVacancies = DistribucionVacante::distinct()->pluck('programa_academico_id')->toArray();

        return view('livewire.admision.vacancy-distribution.assing-vacancies');
    }

    public function updatedSelectedSede()
    {
        session(['selectedSede' => $this->selectedSede]);
    }
}
