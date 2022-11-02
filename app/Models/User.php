<?php
// DB処理・ロジック

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable   // [Authenticatable]を継承して[User]クラスを作る
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // テーブル名

    // 可変項目(保存したい値)
    protected $fillable = [
        'name',
        'email',
        'password',
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
    ];

    public function likes()
    {
        return $this->hasMany('App\Like');
    }
 

    public function nices() {
        return $this->hasMany(Nice::class);
    }
    public function posts() {
        return $this->hasMany('App\Models\Post');
    }
 
    // // フォロー機能のリレーション
    public function followers()
   {
       return $this->belongsToMany(User::class, 'followers', 'followed_id', 'following_id');
   }
 
   public function follows()
   {
       return $this->belongsToMany(User::class, 'followers', 'following_id', 'followed_id');
   }

   // フォローする
   public function follow($user_id)
   {
       return $this->follows()->attach($user_id);
   }
 
   // フォロー解除する
   public function unfollow($user_id)
   {
       return $this->follows()->detach($user_id);
   }
 
   // フォローしているか
   public function isFollowing($user_id)
   {
       return (boolean) $this->follows()->where('followed_id', $user_id)->first(['id']);
   }
 
   // フォローされているか
   public function isFollowed($user_id)
   {
       return (boolean) $this->followers()->where('following_id', $user_id)->first(['id']);
   }

   public function following_each(){
    //ユーザがフォロー中のユーザを取得
    $userIds = $this->followings()->pluck('users.id')->toArray();
    return $userIds;
}

}
