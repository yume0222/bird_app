<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //追加
use DateTime; //追加

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->insert([
            'user_id' => 1,
            'category_id' => 1,
            'body' => 'ぴよぴよぴよぴよぴよぴよぴよぴよぴよぴよ',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'deleted_at' => NULL,
        ]);
    }
}
