<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetBirdPost extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'type',
        'gender',
        'birthday',
        'personality',
        'special_skil',
        'post_id'
    ]; //投稿を保存
    
    //1対1
    public function post(){
        return $this->belongsTo(Post::class);
    }
    
    //ペジネーション、Eagerローディング
    public function getPaginateByLimit(int $limit_count = 10)
    {
        return $this::with('post')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}

