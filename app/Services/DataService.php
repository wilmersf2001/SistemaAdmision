<?php

namespace App\Services;

use App\Models\Departamento;
use App\Models\Distrito;
use App\Models\Pais;
use App\Models\Provincia;
use App\Models\ProgramaAcademico;
use App\Models\Modalidad;
use App\Models\Sede;

use Illuminate\Support\Facades\Cache;

class DataService
{

    public function getDepartaments()
    {
        return Cache::remember('departments', 60, function () {
            return Departamento::all();
        });
    }
    public function getProvinces()
    {
        return Cache::remember('provinces', 60, function () {
            return Provincia::all();
        });
    }

    public function getDistricts()
    {
        return Cache::remember('districts', 60, function () {
            return Distrito::all();
        });
    }

    public function getCountries()
    {
        return Cache::remember('countries', 60, function () {
            return Pais::all();
        });
    }

    public function getModalities()
    {
        return Cache::remember('modalities', 60, function () {
            return Modalidad::all();
        });
    }

    public function getAcademicsProgram()
    {
        return Cache::remember('academicsProgram', 60, function () {
            return ProgramaAcademico::all();
        });
    }

    public function getSedes()
    {
        return Cache::remember('sedes', 60, function () {
            return Sede::all();
        });
    }
}
