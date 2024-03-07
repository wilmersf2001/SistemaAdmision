<?php

namespace App\Http\Controllers\Inscripcion;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApplicantRequest;
use App\Http\Requests\UpdateApplicantRequest;
use App\Http\Requests\UpdateApoderadoRequest;
use Illuminate\Support\Facades\Storage;
use App\Utils\UtilFunction;
use App\Models\Postulante;
use App\Utils\Constants;
use App\Models\Banco;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    private function uploadImage($file, string $name, string $destination)
    {
        if ($file) {
            $filename = $name . '.jpg';
            Storage::disk(Constants::DISK_STORAGE)->put($destination . $filename, file_get_contents($file));
        }
    }

    public function store(StoreApplicantRequest $request)
    {
        $banco = Banco::find($request->banco_id);
        $postulante = Postulante::where('num_documento', $request->num_documento)->first();

        if ($postulante && $postulante->estado_postulante_id != Constants::ESTADO_INSCRIPCION_ANULADA) {
            return redirect()->route('start')->with('alert', 'El postulante ya se encuentra registrado en el proceso de admisión');
        }

        if (!$banco) {
            return redirect()->route('start')->with('alert', 'El número de voucher no se encuentra registrado');
        }

        $banco->update([
            'estado' => 1,
        ]);

        Postulante::create([
            'num_documento' => $request->num_documento,
            'tipo_documento' => $request->tipo_documento,
            'num_voucher' => $request->num_voucher,
            'nombres' => trim(Str::upper($request->nombres)),
            'ap_paterno' => trim(Str::upper($request->ap_paterno)),
            'ap_materno' => trim(Str::upper($request->ap_materno)),
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'sexo_id' => $request->sexo_id,
            'num_documento_apoderado' => $request->filled('num_documento_apoderado') ? $request->num_documento_apoderado : null,
            'nombres_apoderado' => $request->filled('nombres_apoderado') ? trim(Str::upper($request->nombres_apoderado)) : null,
            'ap_paterno_apoderado' => $request->filled('ap_paterno_apoderado') ? trim(Str::upper($request->ap_paterno_apoderado)) : null,
            'ap_materno_apoderado' => $request->filled('ap_materno_apoderado') ? trim(Str::upper($request->ap_materno_apoderado)) : null,
            'distrito_nac_id' => $request->distrito_nac,
            'distrito_res_id' => $request->distrito_res,
            'tipo_direccion_id' => $request->tipo_direccion,
            'direccion' => trim(Str::upper($request->direccion)),
            'telefono' => $request->telefono,
            'telefono_ap' => $request->telefono_ap,
            'correo' => trim(Str::lower($request->correo)),
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
        if ($request->hasFile('profilePhoto') && $request->hasFile('reverseDniPhoto') && $request->hasFile('frontDniPhoto')) {
            $this->uploadImage($request->file('profilePhoto'), $request->num_documento, Constants::RUTA_FOTO_CARNET_INSCRIPTO);
            $this->uploadImage($request->file('reverseDniPhoto'), 'R-' . $request->num_documento, Constants::RUTA_DNI_REVERSO_INSCRIPTO);
            $this->uploadImage($request->file('frontDniPhoto'), 'A-' . $request->num_documento, Constants::RUTA_DNI_ANVERSO_INSCRIPTO);
        } else {
            UtilFunction::copyFileValidFolder($request->num_documento);
        }

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
            'nombres' => trim(Str::upper($request->nombres)),
            'ap_paterno' => trim(Str::upper($request->apPaterno)),
            'ap_materno' => trim(Str::upper($request->apMaterno)),
            'correo' => $request->correo,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'telefono' => $request->telefono,
            'direccion' => trim(Str::upper($request->direccion)),
            'telefono_ap' => $request->telefono_ap,
            'distrito_nac_id' => $request->distrito_n,
            'distrito_res_id' => $request->distrito_r,
            'colegio_id' => $request->colegioId,
            'universidad_id' => $request->filled('idUniversity') ? $request->idUniversity : $applicant->universidad_id,
        ]);

        if ($generateQr) {
            UtilFunction::updateQr($applicant->id);
        }

        return redirect()->route('home.modifyApplicant')->with('success', 'Datos del postulante actualizados correctamente');
    }

    public function updateApoderado(UpdateApoderadoRequest $request, Postulante $applicant)
    {
        $applicant->update([
            'num_documento_apoderado' => $request->num_documento_apoderado,
            'nombres_apoderado' => trim(Str::upper($request->nombres_apoderado)),
            'ap_paterno_apoderado' => trim(Str::upper($request->ap_paterno_apoderado)),
            'ap_materno_apoderado' => trim(Str::upper($request->ap_materno_apoderado)),
        ]);

        return redirect()->route('home.modifyApoderado')->with('success', 'Datos del apoderado actualizados correctamente');
    }
}
