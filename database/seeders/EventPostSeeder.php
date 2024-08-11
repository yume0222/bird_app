<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //追加
use DateTime; //追加

class EventPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('event_posts')->insert([
            'post_id' => 1,
            'prefecture_id' => 1,
            'name' => 'ジャパンバードフェスティバル',
            'start_date' => '2024/07/19',
            'location_detail' => '我孫子市手賀沼周辺',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'deleted_at' => NULL,
        ]);
    }
}
