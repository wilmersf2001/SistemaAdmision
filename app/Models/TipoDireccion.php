<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDireccion extends Model
{
    use HasFactory;

    protected $table = 'tb_tipo_direccion';

    protected $fillable = [
        'descripcion',
    ];

    public function postulantes()
    {
        return $this->hasMany(Postulante::class, 'tipo_direccion_id');
    }
}
