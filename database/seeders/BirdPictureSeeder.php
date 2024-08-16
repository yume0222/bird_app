<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //追加
use DateTime; //追加

class BirdPictureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bird_pictures')->insert([
            'bird_img_path' => 'https://www.maff.go.jp/j/pr/aff/1612/img/spe1_01_01.jpg',
        ]);
        DB::table('bird_pictures')->insert([
            'bird_img_path' => 'https://image.omatsurijapan.com/articleimg/2023/05/275f0470-25677151_m.jpg',
        ]);
        DB::table('bird_pictures')->insert([
            'bird_img_path' => 'https://images.babymo.jp/articles/0/934/photos/compress/934c3569b25640940588e7d8f037d61e334.jpg',
        ]);
    }
}
