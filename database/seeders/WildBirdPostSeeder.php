<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //追加
use DateTime; //追加

class WildBirdPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('wild_bird_posts')->insert([
            'post_id' => 1,
            'prefecture_id' => 1,
            'type' => 'チョウゲンボウ',
            'location_detail' => '多摩川',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'deleted_at' => NULL,
        ]);
    }
}
