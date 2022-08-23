<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'reservation_date' => 'required|date_format:Y-m-d|after:today',
            'reservation_time' => 'required|date_format:H:i:s',
            'coupon_id' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'reservation_date.required' => '来店日を入力してください',
            'reservation_date.after' => '明日以降の日付を入力してください',
            'reservation_time.required' => '来店時間を入力してください',
            'coupon_id.required' => 'クーポンを選択してください'
        ];
    }

}
