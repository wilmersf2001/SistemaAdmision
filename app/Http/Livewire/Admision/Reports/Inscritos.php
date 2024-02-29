<?php

namespace App\Http\Livewire\Admision\Reports;

use App\Models\Postulante;
use Livewire\Component;
use App\Models\Proceso;
use App\Models\ProgramaAcademico;
use Carbon\Carbon;

class Inscritos extends Component
{
    public $fechaDesde;
    public $fechaHasta;
    public $totalInscritos;

    protected function rules()
    {
        return [
            'fechaDesde' => 'required|date|after_or_equal:' . Proceso::getStartDate() . '|before_or_equal:today',
            'fechaHasta' => 'required|date|before_or_equal:today|after_or_equal:fechaDesde',
        ];
    }

    protected $messages = [
        'fechaDesde.required' => 'La fecha de inicio es requerida.',
        'fechaDesde.after_or_equal' => 'Debe ser mayor o igual a la fecha inicio del proceso.',
        'fechaDesde.before_or_equal' => 'No exceda la fecha actual.',
        'fechaHasta.required' => 'La fecha de fin es requerida.',
        'fechaHasta.after_or_equal' => 'La fecha de fin debe ser mayor o igual a la fecha de inicio.',
        'fechaHasta.before_or_equal' => 'No exceda la fecha actual.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->fechaDesde = Proceso::getStartDate();
        $this->fechaHasta = date('Y-m-d');
    }

    public function render()
    {
        $fechaHasta = Carbon::parse($this->fechaHasta)->addDay();

        $postulantesInscritos = Postulante::selectRaw('COUNT(*) as conteo, tb_programa_academico.nombre as programa')
            ->join('tb_programa_academico', 'programa_academico_id', '=', 'tb_programa_academico.id')
            ->whereBetween('fecha_inscripcion', [$this->fechaDesde, $fechaHasta])
            ->groupBy('programa_academico_id', 'tb_programa_academico.nombre')
            ->get();

        return view('livewire.admision.reports.inscritos', compact('postulantesInscritos'));
    }
}
