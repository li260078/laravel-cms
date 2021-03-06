<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordReserRequest extends FormRequest
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
            'email'=>'email',
            'password'=>'required|min:6|confirmed',
            'code'=>[
                'required',
                function ($attribute, $value, $fail) {
                    if ($value != session('code')) {
                        $fail('验证码不正确');
                    }
                },
            ]
        ];
    }
    public function messages()
    {
        return[

            'email.email'=>'请输入正确邮箱',
            'password.required'=>'请输入密码',
            'password.min'=>'密码最少要六位以上',
            'password.confirmed'=>'两次密码不一致',
            'code.required'=>'请输入验证码',
        ];
    }
}
