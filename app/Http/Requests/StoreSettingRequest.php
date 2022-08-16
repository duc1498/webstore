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
            'company.required' => 'Nhap ten',
            'address.required' => 'Nhap address',
            'address2.required' => 'nhap address2',
            'phone.required' => 'nhap phone',
            'hotline.required' => 'nhap hotline',
            'tax.required' => 'nhap tax',
            'facebook.required' => 'nhap facebook',
            'email.required' => 'nhap email',
            'content.required' => 'nhap content',

        ];
    }
}
