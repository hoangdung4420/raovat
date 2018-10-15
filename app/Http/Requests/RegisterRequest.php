<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;
class RegisterRequest extends FormRequest
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
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6'
        ];
    }
     public function messages()
    {
        return [
            'email.required'=>'Bạn phải nhập email',
            'email.email'=>'Không phải là email',
            'email.unique'=>'Email đã tồn tại',
            'password.required'=>'Bạn phải nhập mật khẩu',
            'password.min'=>'Mật khẩu phải lớn hơn 6 kí tự',
        ];
    }
}
