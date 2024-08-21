<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostPicture extends Model
{
    use HasFactory;
    
    // protected $fillable = [
    //   'image_path',
    // ]; //投稿を保存
    
    // //1対多
    // public function post(){
    //     return $this->belongsTo(Post::class);
    // }
    //1対多
    public function post(){
        return $this->belongsTo(Post::class);
    }
    //1対多
    public function picture(){
        return $this->belongsTo(Picture::class);
    }
}
