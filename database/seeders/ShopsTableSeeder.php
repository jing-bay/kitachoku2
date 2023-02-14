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

        $param = [
            'name' => 'テスト1',
            'area_id' => '4',
            'postal_code' => '0620052',
            'address' => '北海道札幌市豊平区月寒東２条１３丁目１−１２',
            'opening_hour' => '10時〜16時',
            'holiday' => '木曜日',
        ];
        Shop::create($param);

        $param = [
            'name' => 'テスト2',
            'area_id' => '4',
            'postal_code' => '0630011',
            'address' => '北海道札幌市西区西区小別沢39',
            'opening_hour' => '10時30分〜17時',
            'holiday' => '不定休',
        ];
        Shop::create($param);

        $param = [
            'name' => 'テスト3',
            'area_id' => '1',
            'postal_code' => '0410833',
            'address' => '北海道函館市陣川町８２−１５４',
            'opening_hour' => '12時00分～18時30分',
            'holiday' => '火曜・金曜以外',
        ];
        Shop::create($param);

        $param = [
            'name' => 'テスト4',
            'area_id' => '1',
            'postal_code' => '0431237',
            'address' => '北海道檜山郡厚沢部町鶉町７１４',
            'opening_hour' => '9時00分～18時00分',
            'holiday' => '不定休',
        ];
        Shop::create($param);

        $param = [
            'name' => 'テスト5',
            'area_id' => '2',
            'postal_code' => '0481711',
            'address' => '北海道虻田郡留寿都村泉川６７−１４',
            'opening_hour' => '8時30分～17時00分',
            'holiday' => '不定休',
        ];
        Shop::create($param);

        $param = [
            'name' => 'テスト6',
            'area_id' => '2',
            'postal_code' => '0440034',
            'address' => '北海道虻田郡倶知安町南４条西１丁目２７',
            'opening_hour' => '8時30分～17時00分',
            'holiday' => '不定休',
        ];
        Shop::create($param);

        $param = [
            'name' => 'テスト7',
            'area_id' => '3',
            'postal_code' => '0540041',
            'address' => '北海道勇払郡むかわ町松風３丁目１−１',
            'opening_hour' => '10時00分～17時00分',
            'holiday' => '不定休',
        ];
        Shop::create($param);

        $param = [
            'name' => 'テスト8',
            'area_id' => '3',
            'postal_code' => '0560017',
            'address' => '北海道日高郡新ひだか町静内御幸町２丁目１−４０',
            'opening_hour' => '9時00分～19時00分',
            'holiday' => '不定休',
        ];
        Shop::create($param);

        $param = [
            'name' => 'テスト9',
            'area_id' => '5',
            'postal_code' => '0683188',
            'address' => '北海道岩見沢市毛陽町５３４',
            'opening_hour' => '9時00分～15時00分',
            'holiday' => '不定休',
        ];
        Shop::create($param);

        $param = [
            'name' => 'テスト10',
            'area_id' => '5',
            'postal_code' => '0741271',
            'address' => '北海道深川市音江町広里783ｰ1',
            'opening_hour' => '9時30分～17時00分',
            'holiday' => '水曜日',
        ];
        Shop::create($param);

        $param = [
            'name' => 'テスト11',
            'area_id' => '6',
            'postal_code' => '0760024',
            'address' => '北海道富良野市幸町１３',
            'opening_hour' => '10時00分～19時00分',
            'holiday' => '水曜日',
        ];
        Shop::create($param);

        $param = [
            'name' => 'テスト12',
            'area_id' => '6',
            'postal_code' => '0760202',
            'address' => '北海道富良野市東山５１３１−１',
            'opening_hour' => '8時30分～16時00分',
            'holiday' => '月〜木曜日',
        ];
        Shop::create($param);

        $param = [
            'name' => 'テスト13',
            'area_id' => '7',
            'postal_code' => '0986222',
            'address' => '北海道宗谷郡猿払村浜鬼志別９９２−３１',
            'opening_hour' => '9時00分～16時30分',
            'holiday' => '日曜日',
        ];
        Shop::create($param);

        $param = [
            'name' => 'テスト14',
            'area_id' => '7',
            'postal_code' => '0983315',
            'address' => '北海道天塩郡天塩町３６６９−２６',
            'opening_hour' => '10時00分～16時00分（土曜のみ12時まで）',
            'holiday' => '不定休',
        ];
        Shop::create($param);

        $param = [
            'name' => 'テスト15',
            'area_id' => '8',
            'postal_code' => '0930133',
            'address' => '北海道網走市字 嘉多山267-4',
            'opening_hour' => '9時00分～16時00分',
            'holiday' => '火曜日',
        ];
        Shop::create($param);

        $param = [
            'name' => 'テスト16',
            'area_id' => '8',
            'postal_code' => '0992107',
            'address' => '北海道北見市端野町川向２４７',
            'opening_hour' => '8時30分～17時00分',
            'holiday' => '不定休',
        ];
        Shop::create($param);

        $param = [
            'name' => 'テスト17',
            'area_id' => '9',
            'postal_code' => '0890377',
            'address' => '北海道御影東７条５丁目2−２',
            'opening_hour' => '8時00分～17時00分',
            'holiday' => '不定休',
        ];
        Shop::create($param);

        $param = [
            'name' => 'テスト18',
            'area_id' => '9',
            'postal_code' => '0890563',
            'address' => ' 北海道中川郡幕別町千住２３５',
            'opening_hour' => '10時00分～16時00分',
            'holiday' => '不定休',
        ];
        Shop::create($param);

        $param = [
            'name' => 'テスト19',
            'area_id' => '10',
            'postal_code' => '0861153',
            'address' => ' 北海道標津郡中標津町桜ヶ丘３丁目１',
            'opening_hour' => '10時00分～17時00分',
            'holiday' => '不定休',
        ];
        Shop::create($param);

        $param = [
            'name' => 'テスト20',
            'area_id' => '10',
            'postal_code' => '0851200',
            'address' => ' 北海道阿寒郡鶴居村下雪裡',
            'opening_hour' => '9時30分～15時00分',
            'holiday' => '月・火・木・金',
        ];
        Shop::create($param);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Shop::reguard();
    }
}
