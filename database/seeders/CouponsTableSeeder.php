<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CouponsTableSeeder extends Seeder
{
    public function run()
    {
        Coupon::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $param = [
            'shop_id' => '1',
            'name' => 'テスト1',
        ];
        Coupon::create($param);

        $param = [
            'shop_id' => '2',
            'name' => 'テスト2',
        ];
        Coupon::create($param);

        $param = [
            'shop_id' => '3',
            'name' => 'テスト3',
        ];
        Coupon::create($param);

        $param = [
            'shop_id' => '4',
            'name' => 'テスト4',
        ];
        Coupon::create($param);

        $param = [
            'shop_id' => '5',
            'name' => 'テスト5',
        ];
        Coupon::create($param);

        $param = [
            'shop_id' => '6',
            'name' => 'テスト6',
        ];
        Coupon::create($param);

        $param = [
            'shop_id' => '7',
            'name' => 'テスト7',
        ];
        Coupon::create($param);

        $param = [
            'shop_id' => '8',
            'name' => 'テスト8',
        ];
        Coupon::create($param);

        $param = [
            'shop_id' => '9',
            'name' => 'テスト9',
        ];
        Coupon::create($param);

        $param = [
            'shop_id' => '10',
            'name' => 'テスト10',
        ];
        Coupon::create($param);

        $param = [
            'shop_id' => '11',
            'name' => 'テスト11',
        ];
        Coupon::create($param);

        $param = [
            'shop_id' => '12',
            'name' => 'テスト12',
        ];
        Coupon::create($param);

        $param = [
            'shop_id' => '13',
            'name' => 'テスト13',
        ];
        Coupon::create($param);

        $param = [
            'shop_id' => '14',
            'name' => 'テスト14',
        ];
        Coupon::create($param);

        $param = [
            'shop_id' => '15',
            'name' => 'テスト15',
        ];
        Coupon::create($param);

        $param = [
            'shop_id' => '16',
            'name' => 'テスト16',
        ];
        Coupon::create($param);

        $param = [
            'shop_id' => '17',
            'name' => 'テスト17',
        ];
        Coupon::create($param);

        $param = [
            'shop_id' => '18',
            'name' => 'テスト18',
        ];
        Coupon::create($param);

        $param = [
            'shop_id' => '19',
            'name' => 'テスト19',
        ];
        Coupon::create($param);

        $param = [
            'shop_id' => '20',
            'name' => 'テスト20',
        ];
        Coupon::create($param);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Coupon::reguard();
    }
}
