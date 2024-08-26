<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    //1対多
    // public function bird_picture(){
    //     return $this->belongsTo(BirdPicture::class);
    // }
    //多対多
    public function bird_pictures(){
        return $this->belongsToMany(BirdPicture::class);
    }
    //多対多
    public function user_bird_pictures(){
        return $this->hasMany(UserBirdPicture::class);
    }
    
    //1対多
    public function prefecture(){
        return $this->belongsTo(Prefecture::class);
    }
    
    //1対多
    public function posts(){
        return $this->hasMany(Post::class);
    }
    
    //1対多
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    
    //1対多
    public function messages(){
        return $this->hasMany(Message::class);
    }
    
    //1対多
    public function chats(){
        return $this->hasMany(Chat::class);
    }
    
    //多対多
    // public function posts(){
    //     return $this->belongsToMany(Post::class);
    // }
    //1対多
    public function likes(){
        return $this->hasMany(Like::class);
    }
    //多対多
    // public function posts(){
    //     return $this->belongsToMany(Post::class);
    // }
    // //多対多
    // public function likes(){
    //     return $this->hasMany(Like::class);
    // }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        
        'prefecture_id',
        'bird_picture_id',
        'self_introduction',
        'gender',
        'age',
        'favorite_bird',
        'bird_watching',
        'my_pet',
        'image_path'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    //Eagerローディング
    public function getPaginateByLimit(int $limit_count = 10)
    {
        return $this::with(['prefecture', 'bird_picture'])->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}
