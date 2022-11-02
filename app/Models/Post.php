<?php
// 投稿のモデル
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    // categoryのリレーション設定
    public function category(){  // 一つの投稿に一人のユーザーだからusersではなくuser
      // return $this->belongsTo(Category::class);
      return $this->belongsTo(Category::class);
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
 
    public function nices() {
        return $this->hasMany('App\Models\Nice');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    //後でViewで使う、いいねされているかを判定するメソッド。
    public function isLikedBy($user): bool {
        return Like::where('user_id', $user->id)->where('post_id', $this->id)->first() !==null;
    }

    public function niceJudge($post) {
      $flg =false;
      foreach($post->nices as $val){
        if($val->user_id === auth()->id()){
          $flg=true;
        }
      }
      return $flg;
    }

     // 可変項目(=保存したい値)
     protected $fillable = 
     [
         'user_id',
         'category_id',
         'content',
         'image',
         'created_at'
     ];

     /**
      * 任意のカテゴリを含むものとする（ローカル）スコープ
      * 
      */
     public function scopeCategoryAt($query, $category_id)
     {
         if (empty($category_id)) {
             return;
         }
      
         return $query->where('category_id', $category_id);
     }

     /**
      * リプライにLIKEを付いているかの判定
      *
      * @return bool true:Likeがついてる false:Likeがついてない
      */
      public function is_niced_by_auth_user()
      {
        $id = Auth::id();
    
        $likers = array();
        foreach($this->nices as $nice) {
          array_push($nicers, $nice->user_id);
        }
    
        if (in_array($id, $nicers)) {
          return true;
        } else {
          return false;
        }
      }

    public function getTimeLines(Int $user_id, Array $follow_ids)
    {
        return $this->whereIn('user_id', $follow_ids)->orderBy('created_at', 'DESC')->paginate();
    }
}
