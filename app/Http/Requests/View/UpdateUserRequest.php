<?php

namespace App\Http\Requests\View;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
      'user.nombre' => 'required|min:3',
      'user.apellido' => 'required|min:3',
      'user.usuario' => 'required|min:3',
      'newPassword' => 'nullable|min:6',
    ];
  }
}
