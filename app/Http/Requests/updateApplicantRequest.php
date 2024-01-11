<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApplicantRequest extends FormRequest
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
            'nombres' => 'required',
            'apPaterno' => 'required',
            'apMaterno' => 'required',
            'distrito_n' => 'required|numeric',
            'distrito_r' => 'required|numeric',
            'correo' => 'required|email',
            'fecha_nacimiento' => 'required|date',
            'telefono' => 'required|numeric',
            'direccion' => 'required',
            'colegioId' => 'required|numeric',
            'telefono_ap' => 'required|numeric',
        ];
    }
}
