<?php

namespace App\Http\Controllers\Admision;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProcessRequest;
use App\Http\Requests\StoreProcessRequest;
use App\Models\Proceso;

class ProcessController extends Controller
{
    public function store(StoreProcessRequest $request)
    {
        Proceso::create([
            'numero' => $request->numeroProceso,
            'descripcion' => $request->descripcion,
            'fecha_inicio' => $request->fechaInicio,
            'fecha_fin' => $request->fechaFin,
        ]);
        return redirect()->route('home.processOpening')->with('success', 'Proceso registrado correctamente');
    }

    public function update(UpdateProcessRequest $request, Proceso $process)
    {
        $process->update([
            'numero' => $request->numeroProceso,
            'descripcion' => $request->descripcion,
            'fecha_inicio' => $request->filled('fechaInicio') ? $request->fechaInicio : $process->fecha_inicio,
            'fecha_fin' => $request->filled('fechaFin') ? $request->fechaFin : $process->fecha_fin,
        ]);

        return redirect()->route('home.processOpening')->with('success', 'Proceso actualizado correctamente');
    }

    public function destroy(Proceso $process)
    {
        $process->delete();
        return redirect()->route('home.processOpening')->with('success', 'Proceso eliminado correctamente');
    }
}
