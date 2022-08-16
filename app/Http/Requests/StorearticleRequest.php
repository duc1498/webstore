<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorearticleRequest extends FormRequest
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
            'slug' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'category_id' => 'required',
            'summary' => 'required',
            'description' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'type'=>'required',
            'position'=>'required',
            'status'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'nhap title ',
            'slug.required' => 'nhap slug',
            'category_id.required' => 'nhap category_id ',
            'summary.required' => 'nhap summary',
            'description.required' => 'nhap description',
            'meta_title.required' => 'nhap meta_title',
            'meta_description.required' => 'nhap meta_description ',
            'type.required'=>'nhap type',
            'position.required'=>'nhap position',
            'status.required'=>'nhap status',
        ];
    }
}
