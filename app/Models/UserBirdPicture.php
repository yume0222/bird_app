<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBirdPicture extends Model
{
    use HasFactory;
    //1対多
    public function user(){
        return $this->belongsTo(User::class);
    }
    //1対多
    public function bird_picture(){
        return $this->belongsTo(BirdPicture::class);
    }
}
