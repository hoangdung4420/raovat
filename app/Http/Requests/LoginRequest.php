<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;
class LoginRequest extends FormRequest
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
            "username" => "required|min:6",
            "password" => "required|min:6",
        ];
    }

    public function messages()
    {
        return [
            "username.required" => "Vui lòng nhập tên đăng nhập hoặc email",
            "username.min" => "Vui lòng nhập đăng nhập hoặc email lớn hơn 6 ký tự",
            "password.required" => "Vui lòng nhập mật khẩu",
            "password.min" => "Vui lòng nhập mật khẩu lớn hơn 6 ký tự",
        ];
    }
}
