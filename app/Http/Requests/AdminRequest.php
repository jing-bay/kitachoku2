<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:40'],
            'email' => ['required', 'email', Rule::unique('admins')->ignore(Auth::guard('admin')->id())],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => '名前を入力してください',
            'name.max' => '40字以内で入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.unique' => '既に存在するメールアドレスです',
            'email.email' => 'メールアドレスの形式で入力してください',
        ];
    }
}