<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id', 
        'post_id',
    ];
    
    //1対多
    public function user(){
        return $this->belongsTo(User::class);
    }
    //1対多
    public function post(){
        return $this->belongsTo(Post::class);
    }
    
    public $timestamps = false;
}
