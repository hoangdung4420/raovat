<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\ParentCategory;
class AddParentCatRequest extends FormRequest
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
            'name'=>'required|unique:parent_categories,name',
            'picture'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Bạn phải thêm tên danh mục',
            'name.unique'=>'Tên danh mục đã tồn tại',
            'picture.required'=>'Bạn phải thêm hình minh họa',
        ];
    }
}
