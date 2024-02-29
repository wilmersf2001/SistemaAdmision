<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    use HasFactory;

    protected $table = 'tb_distrito';

    protected $fillable = [
        'nombre',
        'ubigeo',
        'provincia_id'
    ];

    public function provincia()
    {
        return $this->belongsTo(Provincia::class, 'provincia_id');
    }

    public function postulantes()
    {
        return $this->hasMany(Postulante::class, 'distrito_id');
    }

    public function colegios()
    {
        return $this->hasMany(Colegio::class, 'distrito_id');
    }
}
