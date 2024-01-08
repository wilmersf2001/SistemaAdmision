<?php

namespace App\Http\Livewire\Admision\Process;

use Livewire\Component;
use App\Models\Proceso;

class Close extends Component
{
    public $process;
    public function mount(Proceso $process)
    {
        $this->process = $process;
    }
    public function render()
    {
        $process = new Proceso();
        $ongoingProcess = $process::where('estado', 1)->first();
        $processNumber = $process->getProcessNumber();

        return view('livewire.admision.process.close', compact('processNumber'));
    }

    public function modifyProcessStatus()
    {
        Proceso::where('id', $this->process->id)->update(['estado' => 2]);
        $this->emit('closeModal');
        $this->skipRender();
    }
}
