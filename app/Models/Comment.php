<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //削除

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes; //削除
    
    protected $fillable = [
        'comment',
        'post_id',
        'user_id',
    ]; //投稿を保存
    
    //1対多
    public function post(){
        return $this->belongsTo(Post::class);
    }
    
    //1対多
    public function user(){
        return $this->belongsTo(User::class);
    }
}
