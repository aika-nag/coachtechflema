<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $param = [
            'name' => '腕時計',
            'brand' => 'Rolax',
            'description' => 'スタイリッシュなデザインのメンズ腕時計',
            'price' => '15000',
            'condition' => '1',
            'user_id' => '1',
            'image' => '/dammy1Clock.jpg'
        ];
        DB::table('items')->insert($param);
        $param = [
            'name' => 'HDD',
            'brand' => '西芝',
            'description' => '高速で信頼性の高いハードディスク',
            'price' => '5000',
            'condition' => '2',
            'user_id' => '2',
            'image' => '/dammy2HDD.jpg'
        ];
        DB::table('items')->insert($param);
        $param = [
            'name' => '玉ねぎ３束',
            'brand' => 'なし',
            'description' => '新鮮な玉ねぎ３束のセット',
            'price' => '300',
            'condition' => '3',
            'user_id' => '3',
            'image' => '/dammy3onion.jpg'
        ];
        DB::table('items')->insert($param);
        $param = [
            'name' => '革靴',
            'brand' => '',
            'description' => 'クラシックなデザインの革靴',
            'price' => '4000',
            'condition' => '4',
            'user_id' => '4',
            'image' => '/dammy4shoes.jpg'
        ];
        DB::table('items')->insert($param);
        $param = [
            'name' => 'ノートPC',
            'brand' => '',
            'description' => '高性能なノートパソコン',
            'price' => '45000',
            'condition' => '1',
            'user_id' => '5',
            'image' => '/dammy5pc.jpg'
        ];
        DB::table('items')->insert($param);
        $param = [
            'name' => 'マイク',
            'brand' => 'なし',
            'description' => '高音質のレコーディング用マイク',
            'price' => '8000',
            'condition' => '2',
            'user_id' => '6',
            'image' => '/dammy6mike.jpg'
        ];
        DB::table('items')->insert($param);
        $param = [
            'name' => 'ショルダーバッグ',
            'brand' => '',
            'description' => 'おしゃれなショルダーバッグ',
            'price' => '3500',
            'condition' => '3',
            'user_id' => '7',
            'image' => '/dammy7bag.jpg'
        ];
        DB::table('items')->insert($param);
        $param = [
            'name' => 'タンブラー',
            'brand' => 'なし',
            'description' => '使いやすいタンブラー',
            'price' => '500',
            'condition' => '4',
            'user_id' => '8',
            'image' => '/dammy8Tumbler.jpg'
        ];
        DB::table('items')->insert($param);
        $param = [
            'name' => 'コーヒーミル',
            'brand' => 'Starbacks',
            'description' => '手動のコーヒーミル',
            'price' => '4000',
            'condition' => '1',
            'user_id' => '9',
            'image' => '/dammy9coffee.jpg'
        ];
        DB::table('items')->insert($param);
        $param = [
            'name' => 'メイクセット',
            'brand' => '',
            'description' => '便利なメイクアップセット',
            'price' => '2500',
            'condition' => '2',
            'user_id' => '10',
            'image' => '/dammy10make.jpg'
        ];
        DB::table('items')->insert($param);
    }
}
