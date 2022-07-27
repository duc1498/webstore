<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'slug' =>'required',
            'parent_id' => 'required',
            'position' =>'required',
            'is_active' =>'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Nhap ten',
            'slug.required' => 'Nhap slug',
            'parent_id.required' => 'nhap parent',
            'position.required' => 'nhap position',
            'is_active.required' =>'nhap is_active ',
        ];
    }
}
