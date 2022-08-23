<?php

namespace Database\Seeders;

use App\Models\Shop;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ShopsTableSeeder extends Seeder
{
    public function run()
    {
    Shop::unguard();
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');

    Shop::factory()->count(100)->create();

    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    Shop::reguard();
    }
}
