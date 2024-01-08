<?php

namespace App\Http\Controllers\Admision;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use App\Models\Postulante;
use App\Utils\Constants;
use App\Models\Proceso;

class MailController extends Controller
{
    public function sendMail(Request $request)
    {
        $process = new Proceso();

        $applicantIdList = json_decode($request->input('applicantIdList'));
        $fileStatus = $request->input('state');
        $file = $request->input('file');
        $applicantDniList = [];
        $viwe = '';
        $isValid = false;
        $processNumber = $process->getProcessNumber();
        $applicants = Postulante::find($applicantIdList);
        $applicantDniList = $applicants->pluck('num_documento')->all();

        if ($file == Constants::CARPETA_ARCHIVOS_VALIDOS) {
            $viwe = ($fileStatus == Constants::ESTADO_INSCRITO) ? 'admision.postulante.valid-photos' : 'admision.postulante.valid-rectified-photos';
            $this->updateApplicantStatus($applicantDniList, Constants::ESTADO_VALIDO);
            $isValid = true;
        } elseif ($file == Constants::CARPETA_ARCHIVOS_OBSERVADOS) {
            $viwe = ($fileStatus == Constants::ESTADO_INSCRITO) ? 'admision.postulante.observed-photos' : 'admision.postulante.rectify-photos';
            $this->updateApplicantStatus($applicantDniList, Constants::ESTADO_OBSERVADO);
            $isValid = false;
        }

        foreach ($applicants as $applicant) {
            $email = $applicant->correo;
            $recipientName = implode(' ', [
                $applicant->nombres,
                $applicant->ap_paterno,
                $applicant->ap_materno
            ]);
            $sexo = $applicant->sexo_id;

            SendEmailJob::dispatch($email, $recipientName, $sexo, $isValid, $processNumber);
        }

        return view($viwe, compact('file', 'fileStatus'));
    }

    public function updateApplicantStatus($applicantDniList, $status)
    {
        Postulante::whereIn('num_documento', $applicantDniList)->update(['estado_postulante_id' => $status]);
    }
}
