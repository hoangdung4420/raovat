<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthLoginRequest extends FormRequest
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
            "email" => "required|min:6",
            "password" => "required|min:6",
        ];
    }

    public function messages()
    {
        return [
            "email.required" => "Vui lòng nhập email",
            "email.min" => "email phải lớn hơn 6 kí tự",
            "password.required" => "Vui lòng nhập mật khẩu",
            "password.min" => "Vui lòng nhập mật khẩu lớn hơn 6 ký tự",
        ];
    }
}
