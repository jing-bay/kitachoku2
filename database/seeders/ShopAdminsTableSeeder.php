<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\ShopAdmin;

class ShopAdminsTableSeeder extends Seeder
{
    public function run()
    {
        ShopAdmin::factory()->count(20)->create();
    }
}
