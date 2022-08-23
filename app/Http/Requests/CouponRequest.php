<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:50'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'クーポン名を入力してください',
            'name.max' => '50字以内で入力してください',
        ];
    }
}
