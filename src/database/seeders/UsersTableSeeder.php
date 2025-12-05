<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
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
            'name' => '山田 花子',
            'email' => 'hanako@test.jp',
            'email_verified_at' => now(),
            'password' => Hash::make('coachhanako'),
            'remember_token' => Str::random(10),
        ];
        $data = [
            'user_id' => '11',
            'name' => 'hana',
            'zipcode' => '100-5678',
            'address' => '東京都千代田区千代田123',
            'building' => '千代田ハイム',
            'image' =>'user_hanako.png'
        ];
        DB::table('users')->insert($param);
        DB::table('profiles')->insert($data);
        $param = [
            'name' => '鈴木 一郎',
            'email' => 'ichiro@test.jp',
            'email_verified_at' => now(),
            'password' => Hash::make('techichiro'),
            'remember_token' => Str::random(10),
        ];
        $data = [
            'user_id' => '12',
            'name' => 'イチロー',
            'zipcode' => '200-3456',
            'address' => '北海道札幌市豊平',
            'building' => '豊平アパート',
            'image' =>'user_suzuki.png'
        ];
        DB::table('users')->insert($param);
        DB::table('profiles')->insert($data);
    }
}
