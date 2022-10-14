<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name2' => 'required|string|max:100',
            'area_id' => 'required|integer',
            'postal_code' => 'required|string|size:7',
            'address' => 'required|string|max:100',
            'opening_hour' => 'required|string|max:100',
            'holiday' => 'required|string|max:100',
            'tel_number' => 'nullable|string|between:10,11',
            'email2' => 'nullable|email',
            'overview' => 'required|string|max:250',
            'shop_img' => 'required|file',
            'shop_url' => 'nullable|url',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
        ];
    }

    public function messages()
    {
        return [
            'name2.required' => '名前を入力してください',
            'name2.max' => '100字以内で入力してください',
            'area_id.required' => 'エリアを選択してください',
            'postal_code.required' => '郵便番号を入力してください',
            'postal_code.size' => 'ハイフンなしの７桁で入力してください',
            'postal_code.numeric' => '半角数字で入力してください',
            'address.required' => '住所を入力してください',
            'address.max' => '100字以内で入力してください',
            'opening_hour.required' => '営業時間を入力してください',
            'opening_hour.max' => '100字以内で入力してください',
            'holiday.required' => '定休日を入力してください',
            'holiday.max' => '100字以内で入力してください',
            'tel_number.between' => 'ハイフンなしの番号を半角で入力してください',
            'email2.email' => '有効なメールアドレスを入力してください',
            'overview.required' => '店舗の説明を入力してください',
            'overview.max' => '250字以内で入力してください',
            'shop_img.required'  => '画像は必ず指定してください',
            'facebook_url.url' => 'FacebookのURLを入力してください',
            'twitter_url.url' =>'TwitterのURLを入力してください'
        ];
    }
}
