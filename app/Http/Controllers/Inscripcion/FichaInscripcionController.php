<?php

namespace App\Http\Controllers\Inscripcion;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRectifierPhotoRequest;
use App\Http\Requests\ValidatePdfRequest;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Utils\UtilFunction;
use App\Models\Postulante;
use App\Models\Proceso;
use App\Utils\Constants;
use Illuminate\Http\Request;


class FichaInscripcionController extends Controller
{
    protected function uploadIfFileExists($file, string $name, string $destination)
    {
        if ($file) {
            $filename = $name . '.jpg';
            Storage::disk(Constants::DISK_STORAGE)->put($destination . $filename, file_get_contents($file));
        }
    }

    public function __invoke()
    {
        return view('inscripcion.ficha-inscripcion');
    }

    public function validatePdf(ValidatePdfRequest $request)
    {
        $applicant = Postulante::where('num_documento', $request->num_documento)
            ->where('num_voucher', $request->num_voucher)
            ->first();

        if (!$applicant || $applicant->estado_postulante_id == Constants::ESTADO_INSCRIPCION_ANULADA) {
            return redirect()->route('ficha.startPdfQuery')->with('error', 'Postulante no encontrado o datos ingresados incorrectamente');
        }

        if ($applicant->estado_postulante_id == Constants::ESTADO_ENVIO_OBSERVADO) {
            return redirect()->route('ficha.startPdfQuery')->with('error', 'Tus fotos ya han sido rectificadas, por favor vuelva a intentarlo más tarde');
        }

        if (in_array($applicant->estado_postulante_id, Constants::ESTADO_FICHA_ENTREGADA)) {
            return redirect()->route('ficha.startPdfQuery')->with('success', 'Tu ficha de incripcion ya ha sido generada y tus archivos han sido validados');
        }

        if ($applicant->estadoObservadoFichaInscripcion()) {
            $observedPhotos = UtilFunction::getPhotosObservedByDni($applicant->num_documento);
            if (!$observedPhotos) return redirect()->route('ficha.startPdfQuery');
            return view('inscripcion.rectifier-photo-applicant', compact('applicant', 'observedPhotos'));
        } else {
            if ($applicant->estadoValidoFichaInscripcion()) {
                if (!UtilFunction::photoCarnetExists($request->num_documento)) return redirect()->route('ficha.startPdfQuery');
                $today = UtilFunction::getDateToday();
                $pathImage = UtilFunction::getImagePathByDni($request->num_documento);
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
            } else {
                return redirect()->route('ficha.startPdfQuery')->with('error', 'Ficha de inscripción se encuentra en proceso de validación, por favor vuelva a intentarlo más tarde');
            }
        }

        return PDF::loadView('inscripcion.pdf-ficha-inscripcion', $data)->stream();
    }

    public function storeRectifiedPhotos(StoreRectifierPhotoRequest $request)
    {
        $applicant = Postulante::find($request->applicant_id);
        $applicant->update([
            'estado_postulante_id' => Constants::ESTADO_ENVIO_OBSERVADO,
        ]);

        $this->uploadIfFileExists($request->file('photo_perfil'), $applicant->num_documento, Constants::RUTA_FOTO_CARNET_RECTIFICADO);
        $this->uploadIfFileExists($request->file('photo_anverso'), 'A-' . $applicant->num_documento, Constants::RUTA_DNI_ANVERSO_RECTIFICADO);
        $this->uploadIfFileExists($request->file('photo_reverso'), 'R-' . $applicant->num_documento, Constants::RUTA_DNI_REVERSO_RECTIFICADO);

        return redirect()->route('ficha.startPdfQuery')->with('success', 'Tus fotos han sido rectificadas y enviadas correctamente, por favor vuelva a intentarlo más tarde');
    }
}
