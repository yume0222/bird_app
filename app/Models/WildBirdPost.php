<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WildBirdPost extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'type',
        'location_detail',
        'post_id',
        'prefecture_id'
    ]; //投稿を保存
    
    //1対多
    public function prefecture(){
        return $this->belongsTo(Prefecture::class);
    }
    
    //1対1
    public function post(){
        return $this->belongsTo(Post::class);
    }
    
    //ペジネーション、Eagerローディング
    public function getPaginateByLimit(int $limit_count = 10)
    {
        return $this::with('post', 'prefecture')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}
