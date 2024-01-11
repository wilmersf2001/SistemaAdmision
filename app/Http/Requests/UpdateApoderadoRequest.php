<?php

namespace App\Http\Requests;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'num_documento_apoderado' => 'required|numeric|regex:/^\d{8,9}$/',
            'nombres_apoderado' => 'required',
            'ap_paterno_apoderado' => 'required',
            'ap_materno_apoderado' => 'required',
        ];
    }
}
