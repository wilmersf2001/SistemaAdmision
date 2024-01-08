<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modalidad extends Model
{
    use HasFactory;

    protected $table = 'tb_modalidad';

    protected $fillable = [
        'descripcion',
        'monto_nacional',
        'monto_particular',
        'estado',
        'examen_id',
    ];

    public function postulantes()
    {
        return $this->hasMany(Postulante::class, 'modalidad_id');
    }

    public function examen()
    {
        return $this->belongsTo(Examen::class, 'examen_id');
    }

    public static function getModalidadesEnabled()
    {
        return Modalidad::where('estado', 1)->get();
    }
}
