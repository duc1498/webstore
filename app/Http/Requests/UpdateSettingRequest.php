<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
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
            'company' => 'required|max:255',
            'address' => 'required',
            'address2' =>'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'phone' =>'required',
            'hotline' =>'required',
            'tax' =>'required',
            'facebook' =>'required',
            'email' =>'required',
            'introduce' =>'required',
            'content' =>'required',
            'open_time'=>'nullable'
        ];
    }
    public function messages()
    {
        return [
            'company.required' => 'Nhập company',
            'address.required' => 'Nhập address',
            'address2.required' =>'Nhập address2',
            'phone.required' =>'Nhập phone',
            'hotline.required' =>'Nhập hotline',
            'tax.required' =>'Nhập tax',
            'facebook.required' =>'Nhập facebook',
            'email.required' =>'Nhập email',
            'introduce.required' =>'Nhập introduce',
            'content.required' =>'Nhập content',
        ];
    }
}
