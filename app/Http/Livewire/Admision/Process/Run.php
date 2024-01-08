<?php

namespace App\Http\Livewire\Admision\Process;

use Livewire\Component;
use App\Models\Proceso;

class Run extends Component
{
    public $process;

    public function mount(Proceso $process)
    {
        $this->process = $process;
    }

    public function render()
    {
        $process = new Proceso();
        $ongoingProcess = $process::where('estado', 1)->exists();
        $processNumber = $process->getProcessNumber();

        return view('livewire.admision.process.run', compact('ongoingProcess', 'processNumber'));
    }

    public function runProcess()
    {
        Proceso::where('id', $this->process->id)->update(['estado' => 1]);
        $this->emit('closeModal');
        $this->skipRender();
    }
}
