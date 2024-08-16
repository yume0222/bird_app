<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; //Userモデルをインポート
use App\Models\BirdPicture; //BirdPictureモデルをインポート
use App\Models\UserBirdPicture; //UserBirdPictureモデルをインポート
use Cloudinary; //画像
use Illuminate\Support\Facades\Auth;

class BirdPictureController extends Controller
{
    public function picture(Request $request, BirdPicture $bird_picture)
    {
        return view('profile.picture');
    }
    
    public function store(Request $request, BirdPicture $bird_picture,) //画像保存
    {
        //bird_picturesテーブル（主）に登録
        //画像ファイルが送られた時だけ処理が実行
        $user = Auth::user();
        
        $input = $request['bird_picture'];

        // $inputが配列であることを確認
        if (!is_array($input)) {
            $input = [];
        }
        
        if ($request->file('bird_img_path')) {
            $image_url = Cloudinary::upload($request->file('bird_img_path')->getRealPath())->getSecurePath();
            $input += ['bird_img_path' => $image_url];
        }
        $bird_picture->fill($input)->save();
        
        $user_bird_picture = new UserBirdPicture;
        $user_bird_picture->user_id = $user->id;
        $user_bird_picture->bird_picture_id = $bird_picture->id;
        $user_bird_picture->save();

        return redirect('/profile/edit'); //プロフィール編集にリダイレクト
    }
}
