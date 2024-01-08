<?php

namespace App\Services;

use App\Models\Departamento;
use App\Models\Distrito;
use App\Models\Pais;
use App\Models\Provincia;
use Illuminate\Support\Facades\Cache;

class LocationService
{
  public function getDepartments()
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
}
