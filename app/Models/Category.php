<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    /**
     * カテゴリーの一覧を取得
     */
    public function getLists()
    {
        $categories = Category::orderBy('id','asc')->pluck('category_name', 'id');
     
        return $categories;
    }

    public function post(){  // 一つの投稿に
        return $this->belongsTo(Post::class);
        // PostクラスはPost.phpモデルを指す
        // belongsToのリレーションで関係を結ぶ
    }

    /**
     * カテゴリーの一覧を取得
     */
    // public function getLists()
    // {
    //     $categories = Category::orderBy('id','asc')->pluck('name', 'id');
     
    //     return $categories;
    // }


}
