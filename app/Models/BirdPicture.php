<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BirdPicture extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'bird_img_path',
    ]; //投稿を保存
    
    //1対多
    // public function user(){
    //     return $this->hasOne(User::class);
    // }
    //多対多
    public function users(){
        return $this->belongsToMany(User::class);
    }
    //多対多
    public function user_bird_pictures(){
        return $this->hasMany(UserBirdPicture::class);
    }
    
    public $timestamps = false;
}
