<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
// use宣言追加
use App\Models\Post;
use App\Models\Nice;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;


class NiceController extends Controller
{
    // only()の引数内のメソッドはログイン時のみ有効
    public function __construct()
    {
      $this->middleware(['auth', 'verified'])->only(['nice', 'unnice']);
    }

    // いいね」をつけるためにniceメソッド
    public function nice(Request $request){
        // public function nice(Post $post, Request $request){
        // dd($request->review_id);
        $post = Post::find($request->review_id);
        $flg = true;
        foreach($post->nices as $nice){
            //いいね消し
            if($nice->user_id === auth()->id()){
                $flg=false;
                break;
            }
        }
        if($flg){
            $nice=New Nice();
            $nice->post_id=$post->id;
            $nice->user_id=Auth::user()->id;
            $nice->save();
            $review_likes_count = Nice::where('user_id',Auth::user()->id)
            ->where('post_id', $post->id)
            ->count();
            $param = [
                'review_likes_count' => $review_likes_count,
            ];
            return response()->json($param); //6.JSONデータをjQueryに返す
        }elseif(!$flg){
            $user=Auth::user()->id;
            $nice=Nice::where('post_id', $post->id)->where('user_id', $user)->first();
            $nice->delete();
            $review_likes_count =  Nice::where('user_id',Auth::user()->id)
            ->where('post_id', $post->id)
            ->count();
            $param = [
                'review_likes_count' => $review_likes_count,
            ];
            return response()->json($param); //6.JSONデータをjQueryに返す
        }

    }
}
