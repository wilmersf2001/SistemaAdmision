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

    public function render()
    {
        $this->fechaDesde = Proceso::where('id', 1)->value('fecha_inicio');
        $this->fechaHasta = date('Y-m-d');
        $pagos = Banco::whereBetween('fecha', [$this->fechaDesde, $this->fechaHasta])
            ->orderBy('fecha', 'desc')
            ->paginate(10);

        $this->totalInsNacional = Banco::where('cod_concepto', '00346')
            ->whereBetween('fecha', [$this->fechaDesde, $this->fechaHasta])
            ->count();
        $this->totalInsParticular = Banco::where('cod_concepto', '00345')
            ->whereBetween('fecha', [$this->fechaDesde, $this->fechaHasta])
            ->count();

        return view('livewire.admision.reports.pagos', compact('pagos'));
    }
}
