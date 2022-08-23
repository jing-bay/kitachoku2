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

        Coupon::factory()->count(100)->create();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Coupon::reguard();
    }
}
