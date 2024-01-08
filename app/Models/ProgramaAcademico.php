<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramaAcademico extends Model
{
    use HasFactory;

    protected $table = "tb_programa_academico";

    protected $fillable = [
        'codigo',
        'nombre',
        'estado',
        'sede_id',
        'facultad_id',
        'grupo_academico_id',
    ];

    public function postulantes()
    {
        return $this->hasMany(Postulante::class, 'programa_academico_id');
    }

    public function sede()
    {
        return $this->belongsTo(Sede::class, 'sede_id');
    }

    public function facultad()
    {
        return $this->belongsTo(Facultad::class, 'facultad_id');
    }

    public function grupoAcademico()
    {
        return $this->belongsTo(GrupoAcademico::class, 'grupo_academico_id');
    }
}
