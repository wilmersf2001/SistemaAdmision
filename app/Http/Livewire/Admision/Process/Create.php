<?php

namespace App\Http\Livewire\Admision\Process;

use Livewire\Component;
use App\Models\Proceso;
use Illuminate\Support\Carbon;

class Create extends Component
{
    public $numero_proceso;
    public $fecha_inicio;
    public $fecha_fin;
    public $lastProcessDate = null;

    protected function rules()
    {
        return [
            'numero_proceso' => 'required',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'fecha_inicio' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    if ($this->fecha_fin !== null && $value >= $this->fecha_fin) {
                        $fail('La fecha de inicio debe ser antes de la fecha fin.');
                    }
                },
                function ($attribute, $value, $fail) {
                    if ($this->lastProcessDate !== null && $value <= $this->lastProcessDate) {
                        $fail('fecha inicio debe ser mayor a fecha fin del último proceso.');
                    }
                },
            ],
        ];
    }

    protected $messages = [
        'numero_proceso.required' => 'El número de proceso es requerido.',
        'fecha_fin.after' => 'La fecha de fin debe ser después de la fecha de inicio.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        $processExists = Proceso::where('estado', 0)->exists();
        $lastProcess = Proceso::orderBy('fecha_fin', 'desc')->first();
        $lastProcessDateformatted = null;

        if ($lastProcess) {
            $lastDate = Carbon::create($lastProcess->fecha_fin)->locale('es_PE');
            $lastProcessDateformatted = $lastDate->isoFormat('D [de] MMMM [del] YYYY');
            $this->lastProcessDate = $lastDate->format('Y-m-d');
        }
        return view('livewire.admision.process.create', compact('processExists', 'lastProcess', 'lastProcessDateformatted'));
    }
}
