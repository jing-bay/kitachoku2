<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EvaluationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'evaluation' => 'required|integer|between:1,5',
            'comment' => 'required|string|max:300'
        ];
    }
    public function messages()
    {
        return [
            'evaluation.required' => '評価を入力してください',
            'comment.required' => 'コメントを入力してください',
            'comment.max' => '300字以内で入力してください'
        ];
    }
}
