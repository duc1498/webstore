<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSettingRequest extends FormRequest
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
            // 'company'=>'required',
            // 'address'=>'required',
            // 'address2'=>'required',
            // 'image'=>'required',
            // 'phone'=>'required',
            // 'hotline'=>'required',
            // 'tax'=>'required',
            // 'facebook'=>'required',
            // 'email'=>'required',
            // 'content'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Nhap ten',
            'phone.required' => 'Nhap sdt',
            'email.required' => 'nhap email',
            'content.required' => 'nhap content',
        ];
    }
}
