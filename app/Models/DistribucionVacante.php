<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistribucionVacante extends Model
{
    use HasFactory;

    protected $table = 'tb_distribucion_vacante';

    protected $fillable = [
        'vacantes',
        'programa_academico_id',
        'modalidad_id',
        'sede_id',
    ];

    public function programaAcademico()
    {
        return $this->belongsTo(ProgramaAcademico::class, 'programa_academico_id');
    }

    public function modalidad()
    {
        return $this->belongsTo(Modalidad::class, 'modalidad_id');
    }

    public function sede()
    {
        return $this->belongsTo(Sede::class, 'sede_id');
    }

    public static function getProgramasAcademicosByModalidad($modalidadId)
    {
        return DistribucionVacante::where('modalidad_id', $modalidadId)
            ->get()->sortBy('programaAcademico.nombre');
    }
}
