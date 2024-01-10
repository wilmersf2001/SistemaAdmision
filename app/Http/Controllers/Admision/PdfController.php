<?php

namespace App\Http\Controllers\Admision;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Postulante;
use App\Models\Proceso;
use App\Utils\UtilFunction;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function pdfData($dni)
    {
        $applicant = Postulante::where('num_documento', $dni)->first();

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
}
