<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //追加
use DateTime; //追加

class PetBirdPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pet_bird_posts')->insert([
            'post_id' => 1,
            'type' => 'セキセイインコ',
            'gender' => '雌',
            'birthday' => '2024/07/19',
            'personality' => '可愛い',
            'special_skil' => '可愛い',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'deleted_at' => NULL,
        ]);
    }
}
