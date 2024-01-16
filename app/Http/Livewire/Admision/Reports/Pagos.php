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

    public function mount()
    {
        $this->fechaDesde = Proceso::where('id', 1)->value('fecha_inicio');
        $this->fechaHasta = date('Y-m-d');
    }

    public function render()
    {
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
