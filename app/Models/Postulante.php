<?php

namespace App\Models;

use App\Utils\Constants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulante extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'tb_postulante';

    protected $fillable = [
        'nombres',
        'ap_paterno',
        'ap_materno',
        'fecha_nacimiento',
        'num_documento',
        'tipo_documento',
        'num_documento_apoderado',
        'nombres_apoderado',
        'ap_paterno_apoderado',
        'ap_materno_apoderado',
        'num_voucher',
        'direccion',
        'correo',
        'telefono',
        'telefono_ap',
        'anno_egreso',
        'fecha_inscripcion',
        'num_veces_unprg',
        'num_veces_otros',
        'codigo',
        'sexo_id',
        'distrito_nac_id',
        'distrito_res_id',
        'tipo_direccion_id',
        'modalidad_id',
        'programa_academico_id',
        'colegio_id',
        'universidad_id',
        'sede_id',
        'estado_postulante_id',
        'pais_id',
        'ingreso',
    ];

    public function sexo()
    {
        return $this->belongsTo(Genero::class, 'sexo_id');
    }

    public function distritoNac()
    {
        return $this->belongsTo(Distrito::class, 'distrito_nac_id');
    }

    public function distritoRes()
    {
        return $this->belongsTo(Distrito::class, 'distrito_res_id');
    }

    public function tipodireccion()
    {
        return $this->belongsTo(Tipodireccion::class, 'tipo_direccion_id');
    }

    public function modalidad()
    {
        return $this->belongsTo(Modalidad::class, 'modalidad_id');
    }

    public function programaAcademico()
    {
        return $this->belongsTo(ProgramaAcademico::class, 'programa_academico_id');
    }

    public function colegio()
    {
        return $this->belongsTo(Colegio::class, 'colegio_id');
    }

    public function universidad()
    {
        return $this->belongsTo(Universidad::class, 'universidad_id');
    }

    public function sede()
    {
        return $this->belongsTo(Sede::class, 'sede_id');
    }

    public function estadopostulante()
    {
        return $this->belongsTo(EstadoPostulante::class, 'estado_postulante_id');
    }

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'pais_id');
    }
    public function estadoValidoFichaInscripcion()
    {
        return in_array($this->estado_postulante_id, Constants::ESTADOS_VALIDOS_POSTULANTE);
    }

    public function estadoObservadoFichaInscripcion()
    {
        return in_array($this->estado_postulante_id, Constants::ESTADOS_OBSERVADOS_POSTULANTE);
    }

    public static function fromArrayReniec(array $data)
    {
        $postulante = new Postulante();
        $postulante->nombres = $data['nombres'];
        $postulante->ap_paterno = $data['apellidoPaterno'];
        $postulante->ap_materno = $data['apellidoMaterno'];
        $postulante->num_documento = $data['dni'];
        return $postulante;
    }
}
