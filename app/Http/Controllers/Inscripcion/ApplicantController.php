<?php

namespace App\Http\Controllers\Inscripcion;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApplicantRequest;
use App\Http\Requests\UpdateApplicantRequest;
use Illuminate\Support\Facades\Storage;
use App\Utils\UtilFunction;
use App\Models\Postulante;
use App\Utils\Constants;
use App\Models\Banco;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    private function uploadImage($file, string $name, string $destination)
    {
        if ($file) {
            $filename = $name . '.' . $file->getClientOriginalExtension();
            Storage::disk(Constants::DISK_STORAGE)->put($destination . $filename, file_get_contents($file));
        }
    }
    public function store(StoreApplicantRequest $request)
    {
        $banco = Banco::find($request->banco_id);
        if (!$banco) {
            return response()->json(['error' => 'Banco no encontrado'], 404);
        }

        $banco->update([
            'estado' => 1,
        ]);

        Postulante::create([
            'num_documento' => $request->num_documento,
            'tipo_documento' => $request->tipo_documento,
            'num_voucher' => $request->num_voucher,
            'nombres' => $request->nombres,
            'ap_paterno' => $request->ap_paterno,
            'ap_materno' => $request->ap_materno,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'sexo_id' => $request->sexo_id,
            'num_documento_apoderado' => $request->filled('num_documento_apoderado') ? $request->num_documento_apoderado : null,
            'nombres_apoderado' => $request->filled('nombres_apoderado') ? $request->nombres_apoderado : null,
            'ap_paterno_apoderado' => $request->filled('ap_paterno_apoderado') ? $request->ap_paterno_apoderado : null,
            'ap_materno_apoderado' => $request->filled('ap_materno_apoderado') ? $request->ap_materno_apoderado : null,
            'distrito_nac_id' => $request->distrito_nac,
            'distrito_res_id' => $request->distrito_res,
            'tipo_direccion_id' => $request->tipo_direccion,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'telefono_ap' => $request->telefono_ap,
            'correo' => $request->correo,
            'colegio_id' => $request->colegio_id,
            'universidad_id' => $request->filled('universidad_id') ? $request->universidad_id : null,
            'num_veces_otros' => $request->num_veces_otro,
            'sede_id' => $request->sede_id,
            'pais_id' => $request->tipo_documento == 1 ? 134 : $request->pais_id,
            'programa_academico_id' => $request->programa_academico_id,
            'num_veces_unprg' => $request->num_veces_unprg,
            'modalidad_id' => $request->modalidad_id,
            'anno_egreso' => $request->anno_egreso,
            'fecha_inscripcion' => now(),
            'codigo' => $request->tipo_documento == 1 ? $request->num_documento : substr($request->num_documento, 1),
            'estado_postulante_id' => Constants::ESTADO_INSCRITO,
            'ingreso' => null,
        ]);

        $this->uploadImage($request->file('profilePhoto'), $request->num_documento, Constants::RUTA_FOTO_CARNET_INSCRIPTO);
        $this->uploadImage($request->file('reverseDniPhoto'), 'R-' . $request->num_documento, Constants::RUTA_DNI_REVERSO_INSCRIPTO);
        $this->uploadImage($request->file('frontDniPhoto'), 'A-' . $request->num_documento, Constants::RUTA_DNI_ANVERSO_INSCRIPTO);

        UtilFunction::saveQr($request->all());

        return redirect()->route('applicant.finalMessage');
    }

    public function finalMessage()
    {
        return view('inscripcion.final-message');
    }

    public function update(UpdateApplicantRequest $request, Postulante $applicant)
    {
        $generateQr = UtilFunction::validateQr($request->all(), $applicant->num_documento);

        $applicant->update([
            'nombres' => trim(strtoupper($request->nombres)),
            'ap_paterno' => trim(strtoupper($request->apPaterno)),
            'ap_materno' => trim(strtoupper($request->apMaterno)),
            'correo' => $request->correo,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'telefono_ap' => $request->telefono_ap,
            'distrito_nac_id' => $request->distrito_n,
            'distrito_res_id' => $request->distrito_r,
            'colegio_id' => $request->colegioId,
            'universidad_id' => $request->filled('idUniversity') ? $request->idUniversity : $applicant->universidad_id,
        ]);

        if ($generateQr) {
            UtilFunction::saveQr($applicant->id);
        }

        return redirect()->route('home.modifyApplicant')->with('success', 'Datos del postulante actualizados correctamente');
    }
}
