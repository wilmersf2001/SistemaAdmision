<?php

namespace App\Http\Livewire\Admision\Process;

use Livewire\Component;
use App\Models\Proceso;

class Delete extends Component
{
    public $process;
    public function mount(Proceso $process)
    {
        $this->process = $process;
    }

    public function render()
    {
        return view('livewire.admision.process.delete');
    }
}
