<?php

namespace App\Http\Requests\View;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApoderadoRequest extends FormRequest
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
      'applicant.num_documento_apoderado' => 'required|numeric|regex:/^\d{8,9}$/',
      'applicant.nombres_apoderado' => 'required',
      'applicant.ap_paterno_apoderado' => 'required',
      'applicant.ap_materno_apoderado' => 'required',
    ];
  }
}
