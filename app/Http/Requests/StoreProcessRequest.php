<?php

namespace App\Http\Requests;

use App\Models\Proceso;
use Illuminate\Foundation\Http\FormRequest;

class StoreProcessRequest extends FormRequest
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
    $fechaMaxima = Proceso::max('fecha_fin');
    if (!$fechaMaxima) {
      $fechaMaxima = date('Y-m-d', 0);
    }
    return [
      'numeroProceso' => 'required',
      'descripcion' => 'required',
      'fechaFin' => 'required|date',
      'fechaInicio' => [
        'required',
        'date',
        'before:fechaFin',
        'after:' . $fechaMaxima,
      ],
    ];
  }
}
