<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditPostRequest extends FormRequest
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
            'cat_id'=>'required',
            'district_id'=>'required|numeric',
            'village_id'=>'required|numeric',
            'title'=>'required',
            'detail'=>'required',
            'username'=>'required',
            'email'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'cat_id.required'=>'Bạn phải thêm tên danh mục',
            'district_id.required'=>'Bạn phải thêm quận/huyện',
            'district_id.numeric'=>'Bạn phải thêm quận/huyện',
            'village_id.required'=>'Bạn phải thêm phường/xã',
            'village_id.numeric'=>'Bạn phải thêm phường/xã',
            'title.required'=>'Bạn phải thêm tiêu đề tin',
            'detail.required'=>'Bạn phải thêm chi tiết tin',
            'username.required'=>'Bạn phải thêm tên người liên hệ',
            'email.required'=>'Bạn phải thêm email',
        ];
    }
}
