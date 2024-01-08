<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facultad extends Model
{
    use HasFactory;

    protected $table = "tb_facultad";

    protected $fillable = [
        'codigo',
        'nombre',
        'abreviatura',
        'decano',
    ];
}
