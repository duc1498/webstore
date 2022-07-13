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
            'title'=>'required|max:255',
            'image'=>'image|mimes:jpeg.png,jpg,gif,svg|max:1000',
            'targe'=>'required',
            'description'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Nhập title',
            'image.required' => 'thêm ảnh ',
            'targe.required' => 'chọn target',
            'description.required' => 'nhập ô mô tả'
        ];
    }
}
