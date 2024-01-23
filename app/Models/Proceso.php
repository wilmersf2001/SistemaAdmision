<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

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
        return Cache::remember("processNumber", 60, function () {
            $process = self::where('estado', 1)->first();
            return $process ? date('Y', strtotime($process->fecha_inicio)) . ' - ' . $process->numero : null;
        });
    }

    public static function processOpen()
    {
        return Cache::remember("openProcess", 60, function () {
            return self::where('estado', 1)->exists();
        });
    }

    public static function getStartDate()
    {
        $process = self::where('estado', 1)->first();
        return $process ? $process->fecha_inicio : null;
    }
}
