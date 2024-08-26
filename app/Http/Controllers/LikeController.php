<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; //Postモデルをインポート
use App\Models\User; //Userモデルをインポート
use App\Models\Like; //Likeモデルをインポート
use Illuminate\Support\Facades\Auth; //Auth

class LikeController extends Controller
{
    public function like(Post $post) //いいね保存
    {
        $post->likes()->create(['user_id' => auth()->id()]);
        return redirect()->back();
    }

    public function destroy(Post $post) //いいね削除
    {
        $post->likes()->where('user_id', auth()->id())->delete();
        return redirect()->back();
    }
}
