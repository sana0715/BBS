<?php
// 私の投稿一覧
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $user_id = Auth::id();
        $posts =DB::table('posts')->select('id','category_id','content','image','created_at')->orderBy('created_at','desc')->where('user_id','=',$user_id)->paginate(10);
        return view('post.home', compact('posts'));
    }


    
}
