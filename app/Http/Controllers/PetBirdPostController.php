<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PetBirdPost; //PetBirdPostモデルをインポート
use App\Models\Post; //Postモデルをインポート

class PetBirdPostController extends Controller
{
    public function store(Request $request, PetBirdPost $pet_bird_post, Post $post) //投稿を保存
    {
        
    }
}
