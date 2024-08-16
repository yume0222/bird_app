<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //追加

class UserBirdPictureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_bird_pictures')->insert([
            'bird_picture_id' => 1,
            'user_id' => 1,
        ]);
        DB::table('user_bird_pictures')->insert([
            'bird_picture_id' => 2,
            'user_id' => 1,
        ]);
        DB::table('user_bird_pictures')->insert([
            'bird_picture_id' => 3,
            'user_id' => 2,
        ]);
        
    }
}
