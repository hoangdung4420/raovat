<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class AddUserRequest extends FormRequest
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
            'username' => 'required|min:6|unique:users,username',
            'password' => 'required|min:6',
            'email' => 'unique:users,email',
            'phone' => 'unique:users,phone',
        ];
    }
    public function messages()
    {
        return [
            'username.required'=>'Bạn phải nhập tên người dùng',
            'username.min'=>'Tên người dùng phải lớn hơn 6 kí tự',
            'username.unique'=>'Tên người dùng đã tồn tại',
            'password.required'=>'Bạn phải nhập mật khẩu',
            'password.min'=>'Mật khẩu phải lớn hơn 6 kí tự',
            'email'=>'Email đã tồn tại',
            'phone'=>'Số điện thoại đã tồn tại'
        ];
    }
}
