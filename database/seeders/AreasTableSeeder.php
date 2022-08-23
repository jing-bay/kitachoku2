<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Area;

class AreasTableSeeder extends Seeder
{
    public function run()
    {
        $param = [
            'name' => '渡島・檜山'
        ];
        Area::create($param);
        
        $param = [
            'name' => '後志'
        ];
        Area::create($param);

        $param = [
            'name' => '胆振・日高'
        ];
        Area::create($param);

        $param = [
            'name' => '石狩'
        ];
        Area::create($param);

        $param = [
            'name' => '空知'
        ];
        Area::create($param);

        $param = [
            'name' => '上川'
        ];
        Area::create($param);

        $param = [
            'name' => '留萌・宗谷'
        ];
        Area::create($param);

        $param = [
            'name' => 'オホーツク'
        ];
        Area::create($param);

        $param = [
            'name' => '十勝'
        ];
        Area::create($param);

        $param = [
            'name' => '釧路・根室'
        ];
        Area::create($param);
    }
}
