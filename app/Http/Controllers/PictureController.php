<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; //Postモデルをインポート
use App\Models\Picture; //Pictureモデルをインポート
use App\Models\PostPicture; //PostPictureモデルをインポート
use Cloudinary; //画像

class PictureController extends Controller
{
    public function picture(Request $request, Picture $picture, Post $post)
    {
        return view('posts.picture');
    }
    
    public function store(Request $request, Picture $picture) //画像保存
    {
        //picturesテーブル（主）に登録
        //画像ファイルが送られた時だけ処理が実行
        $input = $request['picture'];

        // $inputが配列であることを確認
        if (!is_array($input)) {
            $input = [];
        }
        
        if ($request->file('img_path')) {
            $image_url = Cloudinary::upload($request->file('img_path')->getRealPath())->getSecurePath();
            $input += ['img_path' => $image_url];
        }
        dd($input);
        $picture->fill($input)->save();
        
        $post_picture = new PostPicture;
        $post_picture->post_id = $post->id;
        $post_picture->picture_id = $picture->id;
        $post_picture->save();

        return redirect('/posts/category/{category}'); //投稿作成にリダイレクト
    }
}
