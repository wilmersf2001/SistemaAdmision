<?php

namespace App\Http\Requests\View;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApplicantWithProgramModality extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
   */
  public function rules(): array
  {
    return [
      'searchByApplicantDni' => 'required|numeric|regex:/^\d{8,9}$/',
      'applicant.nombres' => 'required',
      'applicant.ap_paterno' => 'required',
      'applicant.ap_materno' => 'required',
      'applicant.fecha_nacimiento' => 'required|date',
      'applicant.num_documento' => 'required',
      'applicant.correo' => 'required|email',
      'applicant.telefono' => 'required|numeric|digits:9',
      'applicant.direccion' => 'required',
      'applicant.telefono_ap' => 'required|numeric|digits:9',
      'applicant.distrito_nac_id' => 'required|numeric',
      'applicant.distrito_res_id' => 'required|numeric',
      'applicant.modalidad_id' => 'required|numeric',
      'applicant.programa_academico_id' => 'required|numeric',
      'applicant.colegio_id' => 'required|numeric',
      'applicant.universidad_id' => 'nullable|numeric',
    ];
  }
}
