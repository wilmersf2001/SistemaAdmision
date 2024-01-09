<?php

namespace App\Http\Requests\View;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProgramModalityRequest extends FormRequest
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
      'applicantDni' => 'required|numeric|digits:8',
      'modifiedFieldOne' => 'required',
      'modifiedFieldTwo' => 'required',
      'documentNumberOne' => 'required',
      'documentNumberTwo' => 'required',
    ];
  }
}
