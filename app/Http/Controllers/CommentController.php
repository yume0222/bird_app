<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment; //Commentモデルをインポート
use App\Models\Post; //Postモデルをインポート
use App\Models\User; //Userモデルをインポート
use App\Models\Category; //Categoryモデルをインポート
use Illuminate\Support\Facades\Auth; //Auth
use App\Models\Notification; //Notificationモデルをインポート

class CommentController extends Controller
{
    public function comment(Request $request, Post $post, User $user, Comment $comment) //コメント保存
    {
        $validatedData = $request->validate([
            'comment' => 'required|string|max:255',
        ]);
    
        $comment = new Comment();
        $comment->post_id = $post->id;
        $comment->comment = $validatedData['comment'];
        $comment->user_id = Auth::id();
        $comment->save();
        
        $user = auth()->user();
        // 通知の作成
        Notification::create([
            'user_id' => $post->user_id,
            'type' => 'comment',
            'notifiable_id' => $comment->id,
            'notifiable_type' => Comment::class,
            'data' => [
                'user_name' => $user->name,
                //'user_id' => $user->id,
            ]
        ]);

        return redirect('/posts/' . $post->id);
    }
    
    public function deleteComment(Post $post, Comment $comment) //コメント削除
    {
        $postId = $comment->post_id;
        $comment->delete();
        return redirect('/posts/' . $postId);
    }
    
    public function editComment(Post $post, Comment $comment) //コメント編集画面表示
    {
        //$comment = $comment->comment;
        $commentId = $comment->id;
        $comment->updated_at = now();
        $category = $post->category_id;
        return view('posts.comment_edit')->with(['post' => $post, 'comment' => $comment, 'commentId' => $commentId, 'category' => $category]);
    }
    
    public function updateComment(Request $request, Post $post, Comment $comment) //コメント編集実行
    {
        $postId = $comment->post_id;
        
        $validatedData = $request->validate([
            'comment' => 'required|string|max:255',
        ]);
    
        $comment->comment = $validatedData['comment'];
        $comment->save();
        
        return redirect('/posts/' . $postId);
    }
}
