<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table = 'tb_settings';
    protected $fillable = ['nuDniUsuario', 'nombresApellidos', 'password', 'numeroConsultas', 'fechaActualizacionCredencial'];
}
