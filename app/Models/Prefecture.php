<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prefecture extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
    ]; //投稿を保存
    
    //1対多
    public function users(){
        return $this->hasMany(User::class);
    }
    
    //1対多
    public function wild_bird_posts(){
        return $this->hasMany(WildBirdPost::class);
    }
    
    //1対多
    public function event_posts(){
        return $this->hasMany(EventPost::class);
    }
    
    //1対多
    public function lost_bird_posts(){
        return $this->hasMany(LostBirdPost::class);
    }
}
