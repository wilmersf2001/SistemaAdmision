<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Universidad extends Model
{
    use HasFactory;

    protected $table = 'tb_universidad';

    protected $fillable = [
        'nombre',
        'tipo'
    ];
    public function postulantes()
    {
        return $this->hasMany(Postulante::class, 'universidad_id');
    }
}
