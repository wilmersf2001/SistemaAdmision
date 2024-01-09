<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActualizarModalidadPrograma extends Model
{
    use HasFactory;

    protected $table = 'tb_actualizar_modalidad_programa';
    
    protected $fillable = [
        'dni_postulante',
        'numero_documento',
        'campo_modificado',
        'valor_anterior',
    ];
}
