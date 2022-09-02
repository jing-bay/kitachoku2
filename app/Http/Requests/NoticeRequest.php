<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoticeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'content' => 'required|string|max:50',
        ];
    }

    public function messages()
    {
        return [
            'content.required' => '内容を入力してください',
            'content.max' => '50字以内で入力してください',
        ];
    }
}
