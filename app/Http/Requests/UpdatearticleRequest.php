<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatearticleRequest extends FormRequest
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
            'category_id' => 'nullable',
            'summary' => 'required',
            'description' => 'nullable',
            'meta_title' => 'nullable',
            'meta_description' => 'nullable',
            'type'=>'required',
            'position'=>'required',
            'status'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'nhap title ',
            'category_id.required' => 'nhap category_id ',
            'summary.required' => 'nhap summary',
            'meta_title.required' => 'nhap meta_title',
            'type.required'=>'nhap type',
            'position.required'=>'nhap position',
            'status.required'=>'nhap status',
        ];
    }
}
