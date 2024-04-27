<?php

namespace App\Http\Requests;

use App\Http\Requests\Api\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class moveAlbumRequest extends FormRequest
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
            'album_id' => 'required',
            'id' => 'required',

        ];
    }
    public function messages(): array
    {
        return [
            'id.required' => translate('Curent Album not send'),
            'album_id.required' => translate('Please Select Album'),

        ];
    }
}
