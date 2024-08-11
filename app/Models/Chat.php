<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    
    //1対多
    public function messages(){
        return $this->hasMany(Message::class);
    }
    
    //1対多
    public function user(){
        return $this->belongsTo(User::class);
    }
}
