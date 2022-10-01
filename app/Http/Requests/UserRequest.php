<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $user = User::find($this->id);

        if(empty($user)){
            return [
                'name' => ['required', 'string', 'max:40'],
                'nickname' => ['required', 'string', 'max:40'],
                'email' => ['required', 'email', Rule::unique('users')->ignore(Auth::id())],
            ];
        } else {
            return [
                'name' => ['required', 'string', 'max:40'],
                'nickname' => ['required', 'string', 'max:40'],
                'email' => ['required', 'email', 'unique:users,email,'.$user->email.',email'],
            ];
        }
    }

    public function messages()
    {
        return [
            'name.required' => '名前を入力してください',
            'name.max' => '40字以内で入力してください',
            'nickname.required' => 'ニックネームを入力してください',
            'nickname.max' => '40字以内で入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.unique' => '既に存在するメールアドレスです',
            'email.email' => 'メールアドレスの形式で入力してください',
        ];
    }
}
