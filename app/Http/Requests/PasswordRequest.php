<?php

namespace App\Http\Requests;

use App\Http\Requests\Api\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'current_password'=>'required',
            'password' => 'required|min:6|confirmed',
        ];
    }
    public function messages(): array
    {
        return [
            'current_password.required'=>translate('Please Enter Current Password'),
            'password.required'=>translate('Please Enter Password'),
            'password.min'=>translate('Password Must Be At Least 6 Charachters'),
            'password.confirmed'=>translate('Password & Its Confirmation Not Matching'),
        ];
    }
}
