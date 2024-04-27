<?php

namespace App\Http\Requests;

use App\Http\Requests\Api\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => 'required',
            'user_name' => 'required|unique:users,user_name,'.user()->id.',id,deleted_at,NULL',
            'email' => 'required|email|unique:users,email,'.user()->id.',id,deleted_at,NULL',
            'phone' => 'required|unique:users,phone,'.user()->id.',id,deleted_at,NULL',
            'image' => 'mimes:jpeg,png,jpg,gif,svg,gif,webp',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => translate('Please Enter Your Name'),
            'user_name.required' => translate('Please Enter Your User Name'),
            'user_name.unique' => translate('This User Name Already Used Before'),
            'email.required' => translate('Please Enter Your E-mail'),
            'email.unique' => translate('This E-mail Already Used Before'),
            'image.mimes' => translate('This File Image Not Support'),

        ];
    }
}
