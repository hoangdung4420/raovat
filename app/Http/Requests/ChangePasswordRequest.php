<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'oldpass' => 'required|min:6',
            'newpass' => 'required|min:6',
            'repass' => 'required|same:newpass',
        ];
    }
    public function messages()
    {
        return [
            'oldpass.required'=> 'Bạn phải nhập mật khẩu cũ',
            'oldpass.min'=> 'Mật khẩu phải nhiều hơn 6 kí tự',
            'newpass.required'=> 'Bạn phải nhập mật khẩu mới',
            'newpass.min'=> 'Mật khẩu phải nhiều hơn 6 kí tự',
            'repass.required'=> 'Bạn phải nhập xác nhận mật khẩu',
            'repass.same'=> 'Mật khẩu xác nhận không khớp',
        ];
    }
}
