<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserReniecRequest extends FormRequest
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
            'nuDniUsuario' => 'required|numeric|digits:8|unique:tb_settings,nuDniUsuario',
            'nombresApellidos' => 'required|string|max:60',
            'password' => 'required|string|min:8',
        ];
    }
}
