<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Tag;

class TagsTableSeeder extends Seeder
{
    public function run()
    {
        $param = [
            'name' => '農家直営'
        ];
        Tag::create($param);

        $param = [
            'name' => '複数生産者取り扱い'
        ];
        Tag::create($param);

        $param = [
            'name' => '加工品販売'
        ];
        Tag::create($param);
        
        $param = [
            'name' => '飲食店併設'
        ];
        Tag::create($param);
        
        $param = [
            'name' => 'テイクアウトメニューあり'
        ];  
        Tag::create($param);      
    }
}
