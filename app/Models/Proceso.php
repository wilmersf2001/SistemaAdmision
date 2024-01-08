<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proceso extends Model
{
    use HasFactory;

    protected $table = 'tb_proceso';

    protected $fillable = [
        'numero',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'estado'
    ];

    public static function getProcessNumber()
    {
        $process = self::where('estado', 1)->first();
        return $process ? date('Y', strtotime($process->fecha_inicio)) . ' - ' . $process->numero : null;
    }

    public static function processOpen()
    {
        return self::where('estado', 1)->exists();
    }
}
