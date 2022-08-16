<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBannerRequest extends FormRequest
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
            'title' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'url'=>'required',
            'target' => 'required',
            'description' => 'required',
            'type' => 'required',
            'position'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Nhap ten',
            'url.required' => 'nhap email',
            'target.required' => 'nhap content',
            'description.required'=> 'nhap description',
            'type.required'=>'nhap type ',
            'position.required'=>'nhap position ',
        ];
    }

}
