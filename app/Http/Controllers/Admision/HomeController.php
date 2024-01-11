<?php

namespace App\Http\Controllers\Admision;

use App\Http\Controllers\Controller;
use App\Utils\Constants;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $fullName = Auth::user()->nombre;
        $firstName = explode(' ', $fullName)[0];
        return view('admision.home', compact('firstName'));
    }

    private function getPhotoViewData($file, $status)
    {
        return [
            'file' => $file,
            'fileStatus' => $status,
        ];
    }

    public function validPhotos()
    {
        $data = $this->getPhotoViewData(Constants::CARPETA_ARCHIVOS_VALIDOS, Constants::ESTADO_INSCRITO);
        return view('admision.postulante.valid-photos', $data);
    }

    public function validRectifiedPhotos()
    {
        $data = $this->getPhotoViewData(Constants::CARPETA_ARCHIVOS_VALIDOS, Constants::ESTADO_ENVIO_OBSERVADO);
        return view('admision.postulante.valid-rectified-photos', $data);
    }

    public function observedPhotos()
    {
        $data = $this->getPhotoViewData(Constants::CARPETA_ARCHIVOS_OBSERVADOS, Constants::ESTADO_INSCRITO);
        return view('admision.postulante.observed-photos', $data);
    }

    public function rectifyPhotos()
    {
        $data = $this->getPhotoViewData(Constants::CARPETA_ARCHIVOS_OBSERVADOS, Constants::ESTADO_ENVIO_OBSERVADO);
        return view('admision.postulante.rectify-photos', $data);
    }

    public function modifyApplicant()
    {
        return view('admision.postulante.modify');
    }

    public function inscriptionComprobant()
    {
        return view('admision.postulante.inscription-comprobant');
    }

    public function user()
    {
        return view('admision.user');
    }

    public function uploadTxtFile()
    {
        return view('admision.payments.upload-txt-file');
    }

    public function uploadedFiles()
    {
        return view('admision.payments.uploaded-files');
    }

    public function processOpening()
    {
        return view('admision.process');
    }

    public function assignVacancies()
    {
        return view('admision.vacancy-distribution.assign-vacancies');
    }

    public function vacancyDistribution()
    {
        return view('admision.vacancy-distribution.vacancy-distribution');
    }

    public function carnetPendienteEntrega()
    {
        return view('admision.postulante.carnet-pendiente-entrega');
    }

    public function CarnetEntregado()
    {
        return view('admision.postulante.carnet-entregado');
    }

    public function modifyApoderado()
    {
        return view('admision.postulante.modify-apoderado');
    }

    public function restricted()
    {
        $fullName = Auth::user()->nombre;
        $firstName = explode(' ', $fullName)[0];
        return view('restricted', compact('firstName'));
    }

    public function PageNotFound()
    {
        return view('page-not-found');
    }
}
