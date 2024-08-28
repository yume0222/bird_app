<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; //Postモデルをインポート
use App\Models\User; //Userモデルをインポート
use App\Models\Like; //Likeモデルをインポート
use Illuminate\Support\Facades\Auth; //Auth
use App\Models\Notification; //Notificationモデルをインポート

class LikeController extends Controller
{
    public function like(Post $post) //いいね保存
    {
        $post->likes()->create(['user_id' => auth()->id()]);
        
        $user = auth()->user();
        // 通知の作成
        Notification::create([
            'user_id' => $post->user_id,
            'type' => 'like',
            'notifiable_id' => $post->id,
            'notifiable_type' => Post::class,
            'data' => [
                'user_name' => $user->name,
                //'user_id' => $user->id,
            ]
        ]);
        
        return redirect()->back();
    }

    public function destroy(Post $post) //いいね削除
    {
        $post->likes()->where('user_id', auth()->id())->delete();
        return redirect()->back();
    }
}
