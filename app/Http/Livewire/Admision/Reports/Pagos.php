<?php

namespace App\Http\Livewire\Admision\Reports;

use App\Models\Banco;
use Livewire\Component;

class Pagos extends Component
{
    public function render()
    {
        $pagos = Banco::paginate(10);
        return view('livewire.admision.reports.pagos', compact('pagos'));
    }
}
