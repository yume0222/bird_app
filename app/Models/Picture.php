<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;
    
    protected $fillable = [
       'image_path',
    ]; //投稿を保存
    
    //多対多
    public function posts(){
        return $this->belongsToMany(Post::class);
    }
    //多対多
    public function post_pictures(){
        return $this->hasMany(PostPicture::class);
    }
    
    public $timestamps = false;
}
