<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //追加
use DateTime; //追加

class LostBirdPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // is_bird_owner が true かつ is_bird_rescured が false の場合 迷子 
        // is_bird_owner が false かつ is_bird_rescured が false の場合 目撃 
        // is_bird_owner が false かつ is_bird_rescured が true の場合 保護
        $birds = [
            // ['is_bird_owner' => true, 'is_bird_rescured' => true, 'text' => '-'],
            ['is_bird_owner' => true, 'is_bird_rescured' => false, 'text' => '迷子'],
            ['is_bird_owner' => false, 'is_bird_rescured' => false, 'text' => '目撃'],
            ['is_bird_owner' => false, 'is_bird_rescured' => true, 'text' => '保護'],
        ];
        
        
        foreach ($birds as $bird) {
            DB::table('lost_bird_posts')->insert([
                'post_id' => 1,
                'prefecture_id' => 1,
                'discovery_date' => '2024/07/19',
                'is_bird_owner' => $bird['is_bird_owner'],
                'is_bird_rescured' => $bird['is_bird_rescured'],
                'text' => $bird['text'],
                'location_detail' => '新宿駅',
                'characteristics' => '白い',
                'type' => 'セキセイインコ',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'deleted_at' => NULL,
            ]);
        }
    }
}
