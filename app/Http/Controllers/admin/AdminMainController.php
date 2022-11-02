<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Category;
use App\Models\Like;
use App\Models\Nice;
use App\Models\Follow;
// use App\Models\Follower;
use App\Models\User;

class AdminMainController extends Controller
{
    //
    function show()
    {
        return view("admin.toppage");
    }


    public function allusers()
    {
        $users = DB::table('users')->paginate(10);

        return view('admin.allusers', ['users' => $users]);
    }

    
    // 全ての投稿
    public function allposts(Post $post)
    {
        $posts=Post::orderBy('id','desc')->paginate(9);    // postテーブルに入ってるデータを全て取ってくる
        $user=auth()->user();  // ログインしているユーザの情報を取ってきて＄user変数に代入する
        return view('admin.allposts', compact('posts','user'));
    }


}

