<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidatePaymentRequest extends FormRequest
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
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'numDocument' => 'required|numeric|regex:/^\d{8,9}$/|exists:tb_banco,num_doc_depo',
      'voucherNumber' => 'required|numeric|digits:7|exists:tb_banco,num_documento',
      'agencyNumber' => 'required|numeric|digits:4|exists:tb_banco,num_oficina',
      'payDay' => 'required|date',
      'modalityId' => 'required|numeric',
      'typeSchoolId' => 'required|numeric',
    ];
  }
}
