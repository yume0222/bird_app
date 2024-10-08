<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    
    //1対多
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    //1対多
    public function chat(){
        return $this->belongsTo(Chat::class);
    }
}
