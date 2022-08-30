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
            'company'=>'required',
            'address'=>'required',
            'address2'=>'required',
            'image'=>'nullable',
            'phone'=>'required',
            'hotline'=>'required',
            'tax'=>'required',
            'facebook'=>'required',
            'email'=>'required',
            'content'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'company.required' => 'Nhập ten',
            'address.required' => 'Nhập address',
            'address2.required' => 'Nhập address2',
            'phone.required' => 'Nhập phone',
            'hotline.required' => 'Nhập hotline',
            'tax.required' => 'Nhập tax',
            'facebook.required' => 'Nhập facebook',
            'email.required' => 'Nhập email',
            'content.required' => 'Nhập content',

        ];
    }
}
