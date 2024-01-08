<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRectifierPhotoRequest extends FormRequest
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
        $numberFiles = count(array_filter($this->file()));

        return [
            'applicant_id' => 'required|integer',
            'number_photos' => 'required|integer|size:' . $numberFiles,
            'photo_perfil' => 'required_without_all:photo_anverso,photo_reverso|mimes:jpeg|max:1024',
            'photo_anverso' => 'required_without_all:photo_perfil,photo_reverso|mimes:jpeg|max:1024',
            'photo_reverso' => 'required_without_all:photo_perfil,photo_anverso|mimes:jpeg|max:1024',
        ];
    }
}
