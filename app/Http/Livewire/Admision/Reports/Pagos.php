<?php

namespace App\Http\Livewire\Admision\Reports;

use App\Models\Banco;
use App\Models\Proceso;
use Livewire\Component;

class Pagos extends Component
{
    public $fechaDesde;
    public $fechaHasta;
    public $totalInsNacional;
    public $totalInsParticular;

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
        if ($this->fechaDesde < Proceso::getStartDate()) {
            $this->fechaDesde = Proceso::getStartDate();
        }

        $pagosPagination = Banco::whereBetween('fecha', [$this->fechaDesde, $this->fechaHasta])
            ->orderBy('fecha', 'desc')
            ->paginate(10);

        $pagosTotal = Banco::whereBetween('fecha', [$this->fechaDesde, $this->fechaHasta])
            ->orderBy('fecha', 'desc')
            ->get();

        $this->totalInsNacional = $pagosTotal->where('cod_concepto', '00346')->count();
        $this->totalInsParticular = $pagosTotal->where('cod_concepto', '00345')->count();

        return view('livewire.admision.reports.pagos', compact('pagosPagination'));
    }
}
