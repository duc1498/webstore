<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name.required' => 'Nhập Ten',
            'email.required' => 'Nhập Email',
            'password.required' =>'Nhập password',
            'role_id.required' =>'Nhập hotline',
        ];
    }
}
