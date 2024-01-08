<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoPostulante extends Model
{
    use HasFactory;

    protected $table = 'tb_estado_postulante';

    protected $fillable = [
        'descripcion'
    ];

    public function postulantes()
    {
        return $this->hasMany(Postulante::class, 'estado_postulante_id');
    }
}
