<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalendarRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:50'],
            'start_date' => ['required', 'integer', 'between:1,36'],
            'end_date' => ['required', 'integer', 'between:1,36', 'gte:start_date'],
            'comment' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '商品名を入力してください',
            'name.max' => '50字以内で入力してください',
            'start_date.required' => '開始時期を入力してください',
            'end_date.required' => '終了時期を入力してください',
            'end_date.gte' => '開始時期より前の値は入力しないでください',
            'comment.max' => '255字以内で入力してください'
        ];
    }
}
