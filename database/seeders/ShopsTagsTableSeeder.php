<?php

namespace Database\Seeders;

use App\Models\ShopsTag;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ShopsTagsTableSeeder extends Seeder
{
    public function run()
    {
        ShopsTag::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        ShopsTag::factory()->count(100)->create();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        ShopsTag::reguard();
    }
}
