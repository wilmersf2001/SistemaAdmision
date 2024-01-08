<?php

namespace App\Http\Livewire\Admision\Process;

use Livewire\Component;
use App\Models\Proceso;
use Illuminate\Support\Carbon;

class Update extends Component
{
    public $process;
    public $fecha_inicio = '';
    public $fecha_fin = '';
    public $penultimateDateProcess = null;

    protected function rules()
    {
        return [
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'fecha_inicio' => [
                'required',
                'date',
                'before:fecha_fin',
                function ($attribute, $value, $fail) {
                    if ($this->penultimateDateProcess !== null && $value <= $this->penultimateDateProcess) {
                        $fail('fecha inicio debe ser mayor a fecha fin del último proceso en curso.');
                    }
                },
            ],
        ];
    }

    protected $messages = [
        'fecha_inicio.before' => 'La fecha de inicio no puede ser mayor a la fecha fin.',
        'fecha_fin.after' => 'La fecha de fin no puede ser menor a la fecha inicio.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount(Proceso $process)
    {
        $this->process = $process;
        $this->fecha_inicio = $this->process->fecha_inicio;
        $this->fecha_fin = $this->process->fecha_fin;
    }

    public function render()
    {
        $penultimateProcess = Proceso::orderBy('fecha_fin', 'desc')->skip(1)->first();
        $lastProcessDateformatted = null;

        if ($penultimateProcess) {
            $penultimateDate = Carbon::create($penultimateProcess->fecha_fin)->locale('es_PE');
            $lastProcessDateformatted = $penultimateDate->isoFormat('D [de] MMMM [del] YYYY');
            $this->penultimateDateProcess = $penultimateDate->format('Y-m-d');
        }

        return view('livewire.admision.process.update', compact('lastProcessDateformatted', 'penultimateProcess'));
    }
}
