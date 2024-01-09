<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'tb_banco';

    protected $fillable = [
        'num_oficina',
        'cod_concepto',
        'tipo_doc_pago',
        'num_documento',
        'importe',
        'fecha',
        'hora',
        'estado',
        'num_doc_depo', // DNI, Carnet de extranjeria
        'tipo_doc_depo', // 1: DNI, 9: Carnet de extranjeria
        'observacion_depo',
        'recibo_depo',
        'fecharecibo_depo',
        'monto_depo',
        'descripcion_depo',
        'archivo_txt_id',
    ];

    public static function getImporteByNumDoc($numDoc)
    {
        $importe = Banco::where('num_documento', $numDoc)->value('importe');
        return $importe;
    }
}
