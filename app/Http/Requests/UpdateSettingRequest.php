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
            'company.required' => 'nhap company',
            'address.required' => 'nhap address',
            'address2.required' =>'nhap address2',
            'phone.required' =>'nhap phone',
            'hotline.required' =>'nhap hotline',
            'tax.required' =>'nhap tax',
            'facebook.required' =>'nhap facebook',
            'email.required' =>'nhap email',
            'introduce.required' =>'nhap introduce',
            'content.required' =>'nhap content',
        ];
    }
}
