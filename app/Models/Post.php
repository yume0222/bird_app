<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //削除

class Post extends Model
{
    use HasFactory;
    use SoftDeletes; //削除
    
    protected $fillable = [
        'body',
        'category_id',
        'user_id',
    ]; //投稿を保存
    
    //1対多
    public function category(){
        return $this->belongsTo(Category::class);
    }
    
    //1対多
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    //1対多
    public function post_pictures(){
        return $this->hasMany(PostPicture::class);
    }
    
    //1対多
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    
    //1対1
    public function pet_bird_post(){
        return $this->hasOne(PetBirdPost::class);
    }
    
    //1対1
    public function wild_bird_post(){
        return $this->hasOne(WildBirdPost::class);
    }
    
    //1対1
    public function event_post(){
        return $this->hasOne(EventPost::class);
    }
    
    //1対1
    public function lost_bird_post(){
        return $this->hasOne(LostBirdPost::class);
    }
    
    //多対多
    // public function users(){
    //     return $this->belongsToMany(User::class);
    // }
    //1対多
    public function likes(){
        return $this->hasMany(Like::class);
    }
    
    //ペジネーション、Eagerローディング
    public function getPaginateByLimit(int $limit_count = 10)
    {
        return $this::with(['category', 'user'])->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    // public function getPaginateByLimit(int $limit_count = 10)
    // {
    //     return $this::with(['category', 'user', 'post_picture'])->orderBy('updated_at', 'DESC')->paginate($limit_count);
    // }
}