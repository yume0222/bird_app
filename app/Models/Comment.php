<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    //1対多
    public function post(){
        return $this->belongsTo(Post::class);
    }
    
    //1対多
    public function user(){
        return $this->belongsTo(User::class);
    }
}
