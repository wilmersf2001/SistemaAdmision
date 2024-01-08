<?php

namespace App\Http\Requests\View;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
      'name' => 'required|min:3',
      'lastname' => 'required|min:3',
      'user' => 'required|min:3|unique:tb_usuario,usuario',
      'password' => 'required|min:6',

    ];
  }
}
