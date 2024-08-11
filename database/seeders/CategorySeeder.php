<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //追加
use DateTime; //追加

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
        '愛鳥', '野鳥', 'イベント', '迷子', '雑談', '相談'
        ];
        
        foreach ($categories as $category ) {
            DB::table('categories')->insert([
                'name' => $category
            ]);
        }
    }
}
