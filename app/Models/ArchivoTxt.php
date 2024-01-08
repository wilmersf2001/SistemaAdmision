<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivoTxt extends Model
{
    use HasFactory;

    protected $table = 'tb_archivo_txt';

    protected $fillable = [
        'nombre',
        'cantidad_registros',
    ];
}
