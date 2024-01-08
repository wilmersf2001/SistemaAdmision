<?php

namespace App\Http\Controllers\Admision;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DistribucionVacante;
use App\Http\Requests\StoreVacancyDistributionRequest;

class VacancyDistributionController extends Controller
{
    public function Store(StoreVacancyDistributionRequest $request)
    {
        $sede_id = $request->sedeId;
        $programa_id = $request->programaId;
        $modalities = $request->modalities;

        foreach ($modalities as $modality => $value) {
            DistribucionVacante::create([
                'vacantes' => $value,
                'programa_academico_id' => $programa_id,
                'modalidad_id' => $modality,
                'sede_id' => $sede_id,
            ]);
        }

        return redirect()->route('home.assignVacancies')->with('success', 'Las vacantes se han asignado a la modalidad correctamente');
    }
}
