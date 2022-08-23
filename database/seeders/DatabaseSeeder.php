<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AreasTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(ShopAdminsTableSeeder::class);
        $this->call(ShopsTableSeeder::class);
        $this->call(CouponsTableSeeder::class);
        $this->call(ShopsTagsTableSeeder::class);
    }
}
