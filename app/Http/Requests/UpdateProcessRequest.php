<?php

namespace App\Http\Requests;

use App\Models\Proceso;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProcessRequest extends FormRequest
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
    $process = Proceso::orderBy('fecha_fin', 'desc')->skip(1)->first();

    if ($process) {
      $penultimateDateProcess = $process->fecha_fin;
    } else {
      $penultimateDateProcess = date('Y-m-d', 0);
    }

    $rules = [
      'numeroProceso' => 'required',
      'descripcion' => 'required',
    ];

    if ($this->filled('fechaInicio') && $this->filled('fechaFin')) {
      $rules['fechaFin'] = 'required|date';
      $rules['fechaInicio'] = [
        'nullable',
        'date',
        'before:fechaFin',
        'after:' . $penultimateDateProcess,
      ];
    }

    return $rules;
  }
}
