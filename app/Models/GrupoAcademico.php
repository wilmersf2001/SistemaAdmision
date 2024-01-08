<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoAcademico extends Model
{
    use HasFactory;

    protected $table = "tb_grupo_academico";

    protected $fillable = [
        'letra',
        'nombre',
    ];
}
