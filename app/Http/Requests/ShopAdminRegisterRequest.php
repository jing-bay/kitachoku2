<?php

namespace App\Http\Requests;

use App\Models\ShopAdmin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ShopAdminRegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $shopadmin = ShopAdmin::find($this->id);
        
        if(empty($shopadmin)){
            return [
                'name' => ['required', 'string', 'max:40'],
                'email' => ['required', 'email', Rule::unique('shop_admins')->ignore(Auth::guard('shopadmin')->id())],
                'password' => ['required', 'string', 'between:8,20']
            ];
        } else {
            return [
                'name' => ['required', 'string', 'max:40'],
                'email' => ['required', 'email','unique:shop_admins,email,'.$shopadmin->email.',email'],
                'password' => ['required', 'string', 'between:8,20']
            ];
        }
    }
    public function messages()
    {
        return [
            'name.required' => '名前を入力してください',
            'name.max' => '40字以内で入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.unique' => '既に存在するメールアドレスです',
            'email.email' => 'メールアドレスの形式で入力してください',
            'password.required' => '半角英数でパスワードを入力してください',
            'password.between' => '8文字以上20字以内で入力してください',
        ];
    }
}