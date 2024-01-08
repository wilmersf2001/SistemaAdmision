<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    use HasFactory;

    protected $table = 'tb_sede';

    protected $fillable = [
        'nombre',
        'estado'
    ];

    public function postulantes()
    {
        return $this->hasMany(Postulante::class, 'sede_id');
    }

    public function programasAcademicos()
    {
        return $this->hasMany(ProgramaAcademico::class, 'sede_id');
    }

    public static function getSedesEnabled()
    {
        return Sede::where('estado', 1)->get();
    }
}
