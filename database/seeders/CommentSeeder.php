<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //追加
use DateTime; //追加

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('comments')->insert([
            'user_id' => 1,
            'post_id' => 1,
            'comment' => 'ぴよぴよぴよぴよぴよぴよぴよぴよぴよぴよ',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'deleted_at' => NULL,
        ]);
    }
}
