<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colegio extends Model
{
    use HasFactory;

    protected $table = 'tb_colegio';

    protected $fillable = [
        'nombre',
        'centro_poblado',
        'tipo',
        'ubigeo',
        'distrito_id'
    ];

    public function postulantes()
    {
        return $this->hasMany(Postulante::class, 'colegio_id');
    }

    public function distrito()
    {
        return $this->belongsTo(Distrito::class, 'distrito_id');
    }
}
