<?php

namespace App\Http\Livewire\Admision\Process;

use Livewire\Component;
use App\Models\Proceso;

class Process extends Component
{
    public $listeners = ['closeModal'];
    public $modalSelectedProcess;
    public $showModal = false;
    public $action = 0;
    public $orderDate = 'desc';
    public $orderBy = 'fecha_inicio';

    public function render()
    {
        $processes = Proceso::orderBy($this->orderBy, $this->orderDate)
            ->paginate(10);

        return view('livewire.admision.process.process', compact('processes'));
    }

    public function orderDate($index)
    {
        $this->orderBy = $index == 1 ? 'fecha_inicio' : 'fecha_fin';
        $this->orderDate = ($this->orderDate == 'desc') ? 'asc' : 'desc';
    }
    public function openModal($selectedAction, Proceso $process = null)
    {
        if (
            $selectedAction == 1 ||  ($selectedAction == 2 && $process->estado != 2) ||
            ($selectedAction == 3 && $process->estado != 2) || $selectedAction == 5
        ) {
            $this->updateModal($selectedAction, $process);
        } elseif ($selectedAction == 4) {
            ($process->estado == 1) ? null : $this->updateModal($selectedAction, $process);
        } else {
            return;
        }
    }
    private function updateModal($action, Proceso $process)
    {
        $this->action = $action;
        $this->modalSelectedProcess = $process;
        $this->showModal = !$this->showModal;
    }
    public function closeModal()
    {
        $this->showModal = !$this->showModal;
    }
}
