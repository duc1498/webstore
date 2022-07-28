<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name' => 'required|max:255',
            'email' => 'required',
            'password' =>'required',
            'role_id' => 'required',
            'avatar' =>'nullable',
            'is_active' =>'nullable',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'nhap Ten',
            'email.required' => 'nhap Email',
            'password.required' =>'nhap password',
            'role_id.required' =>'nhap hotline',
        ];
    }
}
