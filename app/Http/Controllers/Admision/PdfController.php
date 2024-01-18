<?php

namespace App\Http\Controllers\Admision;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Postulante;
use App\Models\Banco;
use App\Models\Proceso;
use App\Utils\UtilFunction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Utils\Constants;

class PdfController extends Controller
{
    public function pdfData($dni)
    {
        $applicant = Postulante::where('num_documento', $dni)->where('estado_postulante_id', '!=', Constants::ESTADO_INSCRIPCION_ANULADA)->first();

        if (!$applicant) {
            return redirect()->route('home.inscriptionComprobant')->with('error', 'No se encontró el postulante');
        }

        $today = UtilFunction::getDateToday();
        $pathImage = UtilFunction::getImagePathByDni($applicant->num_documento);
        $process = Proceso::getProcessNumber();
        $lugarNacimiento = UtilFunction::getLocationByPostulante($applicant);
        $lugarResidencia = UtilFunction::getLocationByDistrict($applicant->distritoRes);
        $lugarColegio = UtilFunction::getLocationBySchoolUbigeo($applicant->colegio->ubigeo);
        $isMinor = UtilFunction::isAgeMinor($applicant->fecha_nacimiento);

        $data = [
            'postulante' => $applicant,
            'resultadoQr' => UtilFunction::dataQr($applicant->id),
            'programaAcademico' => $applicant->programaAcademico->nombre,
            'modalidad' => $applicant->modalidad->descripcion,
            'sede' => $applicant->sede->nombre,
            'colegio' => $applicant->colegio->nombre,
            'lugarNacimiento' => $lugarNacimiento,
            'lugarResidencia' => $lugarResidencia,
            'lugarColegio' => $lugarColegio,
            'process' => $process,
            'today' => $today,
            'pathImage' => $pathImage,
            'tipoColegio' => $applicant->colegio->tipo == 1 ? 'Nacional' : 'Privado',
            'laberBirth' => $applicant->tipo_documento == 1 ? 'Lugar de nacimiento' : 'País de procedencia',
            'isMinor' => $isMinor,
        ];

        return PDF::loadView('inscripcion.pdf-ficha-inscripcion', $data)->stream();
    }

    public function reportePagos(Request $request)
    {
        $fechaDesde = $request->fecha_desde;
        $fechaHasta = $request->fecha_hasta;

        $resultadoPagos = Banco::selectRaw('fecha, 
                     SUM(CASE WHEN cod_concepto = "00346" THEN 1 ELSE 0 END) as pago_nacional, 
                     SUM(CASE WHEN cod_concepto = "00345" THEN 1 ELSE 0 END) as pago_particular')
            ->whereBetween('fecha', [$fechaDesde, $fechaHasta])
            ->groupBy('fecha')
            ->orderBy('fecha', 'desc')
            ->get();

        $data = [
            'fechaDesde' => $fechaDesde,
            'fechaHasta' => $fechaHasta,
            'resultadoPagos' => $resultadoPagos,
            'totalPagos' => $resultadoPagos->sum('pago_nacional') + $resultadoPagos->sum('pago_particular'),
            'today' => UtilFunction::getDateToday(),
        ];

        return PDF::loadView('admision.reports.pdf-pagos', $data)->stream();
    }

    public function reporteProgramasInscritos(Request $request)
    {
        $fechaDesde = $request->fecha_desde;
        $fechaHasta = $request->fecha_hasta;

        $resultadoInscritos = Postulante::selectRaw('COUNT(*) as conteo, tb_programa_academico.nombre as programa')
            ->join('tb_programa_academico', 'programa_academico_id', '=', 'tb_programa_academico.id')
            ->whereBetween('fecha_inscripcion', [$fechaDesde, $fechaHasta])
            ->orderBy('tb_programa_academico.nombre', 'asc')
            ->groupBy('programa_academico_id', 'tb_programa_academico.nombre')
            ->get();

        $data = [
            'fechaDesde' => $fechaDesde,
            'fechaHasta' => $fechaHasta,
            'resultadoInscritos' => $resultadoInscritos,
            'today' => UtilFunction::getDateToday(),
        ];

        return PDF::loadView('admision.reports.pdf-programas-inscritos', $data)->stream();
    }

    public function reporteFechasInscritos(Request $request)
    {
        $fechaDesde = $request->fecha_desde;
        $fechaHasta = $request->fecha_hasta;

        $resultadoInscritos = Postulante::selectRaw('COUNT(*) as conteo, DATE(fecha_inscripcion) as fecha_inscripcion')
            ->whereBetween('fecha_inscripcion', [$fechaDesde, $fechaHasta])
            ->orderBy('fecha_inscripcion', 'asc')
            ->groupBy(DB::raw('DATE(fecha_inscripcion)'))
            ->get();

        $data = [
            'fechaDesde' => $fechaDesde,
            'fechaHasta' => $fechaHasta,
            'resultadoInscritos' => $resultadoInscritos,
            'today' => UtilFunction::getDateToday(),
        ];

        return PDF::loadView('admision.reports.pdf-fechas-inscritos', $data)->stream();
    }
}
