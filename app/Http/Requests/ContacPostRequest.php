<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContacPostRequest extends FormRequest
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
            'phone' => 'required',
            'email' => 'required',
            'content' => 'required',
            'open_time'=>'nullable',
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
