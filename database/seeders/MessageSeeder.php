<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //追加
use DateTime; //追加

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('messages')->insert([
            'chat_id' => 1,
            'user_id' => 1,
            'message' => 'あいうえお',
            'created_at' => new DateTime(),
        ]);
    }
}
