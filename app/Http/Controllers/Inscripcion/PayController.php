<?php

namespace App\Http\Controllers\Inscripcion;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidatePaymentRequest;
use App\Models\Setting;
use App\Services\ApiReniecService;
use App\Models\Banco;
use App\Models\Modalidad;
use App\Models\Postulante;
use App\Models\Proceso;
use App\Utils\Constants;
use Illuminate\Http\Request;

class PayController extends Controller
{
  protected ApiReniecService $apiReniec;

  public function __construct(ApiReniecService $apiReniec)
  {
    $this->apiReniec = $apiReniec;
  }

  private function redirectToStartWithAlert($message)
  {
    return redirect()->route('start')->with('alert', $message);
  }

  private function postulantIsAlreadyRegistered($numDocument)
  {
    $postulante = Postulante::where('num_documento', $numDocument)->first();
    return ($postulante && $postulante->estado_postulante_id != Constants::ESTADO_INSCRIPCION_ANULADA);
  }

  public function __invoke()
  {
    $processNumber = Proceso::getProcessNumber();
    return view('inscripcion.validate-payment', compact('processNumber'));
  }

  public function validatePayment(ValidatePaymentRequest $request)
  {
    $userReniecAleatorio = Setting::inRandomOrder()->first();

    $numDocument = $request->numDocument;
    $typeSchool = $request->typeSchoolId;

    $bank = Banco::where('num_doc_depo', $request->numDocument)
      ->where('num_documento', $request->voucherNumber)
      ->where('num_oficina', $request->agencyNumber)
      ->where('fecha', $request->payDay)
      ->first();

    if (!$bank) {
      return $this->redirectToStartWithAlert('Pago no encontrado o pago esta siendo procesado, por favor verifique que los datos esten correctamentes ingresados o vuelva a intentarlo en unos minutos (Recuerde esperar 24 horas para que su pago sea procesado)');
    }

    if ($bank->estado == 1) {
      return $this->redirectToStartWithAlert('Los datos del voucher ingresados ya fueron registrados');
    }

    if ($this->postulantIsAlreadyRegistered($numDocument)) {
      return $this->redirectToStartWithAlert('El postulante ya se encuentra registrado en el proceso de admisión');
    }

    $modality = Modalidad::find($request->modalityId);
    $amount = ($typeSchool == 1) ? $modality->monto_nacional : $modality->monto_particular;
    if ($amount != $bank->importe) {
      return redirect()->route('start')->with('alert', 'El monto del voucher no coincide para la modalidad seleccionada');
    }

    $applicant = $this->apiReniec->getApplicantDataByDni($userReniecAleatorio, $numDocument);
    $applicant->modalidad_id = $request->modalityId;
    $applicant->colegio_id = $bank->tipo_doc_depo == 1 ? null : ($typeSchool == 1 ? 15496 : 15497);

    return view('inscripcion.register-applicant', compact('applicant', 'bank', 'typeSchool'));
  }
}
