<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            BirdPictureSeeder::class,
            LikeSeeder::class,
            PostPictureSeeder::class,
            CategorySeeder::class,
            PrefectureSeeder::class,
            UserSeeder::class,
            ChatSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
            EventPostSeeder::class,
            LostBirdPostSeeder::class,
            MessageSeeder::class,
            PetBirdPostSeeder::class,
            WildBirdPostSeeder::class,
        ]);
    }
}

