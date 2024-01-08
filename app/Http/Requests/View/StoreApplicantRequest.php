<?php

namespace App\Http\Requests\View;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'applicant.nombres' => 'required',
            'applicant.ap_paterno' => 'required',
            'applicant.ap_materno' => 'required',
            'applicant.fecha_nacimiento' => 'required|date|before:2010-01-01',
            'applicant.sexo_id' => 'required|numeric',
            'applicant.distrito_nac_id' => 'required|numeric',
            'applicant.distrito_res_id' => 'required|numeric',
            'applicant.tipo_direccion_id' => 'required|numeric',
            'applicant.num_documento_apoderado' => 'required|numeric|regex:/^\d{8,9}$/',
            'applicant.nombres_apoderado' => 'required',
            'applicant.ap_paterno_apoderado' => 'required',
            'applicant.ap_materno_apoderado' => 'required',
            'applicant.direccion' => 'required',
            'applicant.telefono' => 'required|numeric|digits:9',
            'applicant.telefono_ap' => 'required|numeric|digits:9',
            'applicant.correo' => 'required|email',
            'applicant.sede_id' => 'required|numeric',
            'applicant.programa_academico_id' => 'required|numeric',
            'applicant.num_veces_unprg' => 'required|numeric|integer|gte:0',
            'applicant.num_veces_otros' => 'required|numeric|integer|gte:0',
            'applicant.colegio_id' => 'required|numeric',
            'applicant.universidad_id' => 'required|numeric',
            'applicant.anno_egreso' => 'required|numeric|digits:4',
            'applicant.modalidad_id' => 'required|numeric',
            'applicant.pais_id' => 'required|numeric',
            'selectedProvinceOriginSchoolId' => 'required|numeric',
            'selectedDistrictOriginSchoolId' => 'required|numeric',
            'profilePhoto' => 'required|mimes:jpeg|max:1024',
            'reverseDniPhoto' => 'required|mimes:jpeg|max:1024',
            'frontDniPhoto' => 'required|mimes:jpeg|max:1024',
            'accordance' => 'required|accepted',
        ];
    }
}
