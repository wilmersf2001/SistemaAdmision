<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;

    protected $table = 'tb_examen';

    protected $fillable = [
        'descripcion',
        'estado',
    ];

    public function modalidades()
    {
        return $this->hasMany(Modalidad::class, 'examen_id');
    }
}
