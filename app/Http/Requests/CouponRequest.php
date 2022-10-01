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
            'name3' => 'required|string|max:50'
        ];
    }

    public function messages()
    {
        return [
            'name3.required' => 'クーポン名を入力してください',
            'name3.max' => '50字以内で入力してください',
        ];
    }
}
