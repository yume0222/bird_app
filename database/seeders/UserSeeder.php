<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //追加
use DateTime; //追加
use Illuminate\Support\Facades\Hash; //password
use Illuminate\Support\Str; //name, email

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 100; $i++) {
            DB::table('users')->insert([
                    'name' => '佐藤',
                    'email' => 'a@gmail.com',
                    'password' => Hash::make('password'),
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
                    'self_introduction' => 'セキセイインコが大好きです',
                    'gender' => '女性',
                    'age' => 19, //年齢
                    'favorite_bird' => 'セキセイインコ',
                    'bird_watching' => '多摩川',
                    'my_pet' => 'セキセイインコ',
                    'prefecture_id' => 1,
                    'bird_picture_id' => 1,
                    //'image_path' => 'プロフィール画像です',
                    //email_verified_at
            ]);
        }
        // for ($i = 1; $i <= 100; $i++) {
            DB::table('users')->insert([
                'name' => Str::random(10),
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('password'),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'self_introduction' => 'セキセイインコが大好きです',
                'gender' => '女性',
                'age' => $i, //年齢
                'favorite_bird' => 'セキセイインコ',
                'bird_watching' => '多摩川',
                'my_pet' => 'セキセイインコ',
                'prefecture_id' => 1,
                'bird_picture_id' => 1,
                //'image_path' => 'プロフィール画像です',
                //email_verified_at
            ]);
        // }
        
        // for ($i = 1; $i <= 100; $i++) {
        //     DB::table('users')->insert([
        //         'name' => Str::random(10),
        //         'email' => Str::random(10).'@gmail.com',
        //         'password' => Hash::make('password'),
        //         'created_at' => new DateTime(),
        //         'updated_at' => new DateTime(),
        //         'self_introduction' => 'セキセイインコが大好きです',
        //         'age' => $i, //年齢
        //         'favorite_bird' => 'セキセイインコ',
        //         'bird_watching' => '多摩川',
        //         'my_pet' => 'セキセイインコ',
        //         'prefecture_id' => 1,
        //         'bird_picture_id' => 1,
        //         //性別
        //         //'image_path' => 'プロフィール画像です',
        //         //email_verified_at
        //     ]);
        // }
    }
}
