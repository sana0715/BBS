<?php

namespace App\Http\Controllers;

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
use App\Models\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // カテゴリー別の投稿一覧表示
    public function dashboard(Request $request,Post $post)
    {
        // カテゴリ取得
        $category = new Category;
        $categories = $category->getLists();
        
        $category_id = $request->category_id;
        if (!is_null($category_id)) {
            $posts = Post::where('category_id', $category_id)->orderBy('created_at', 'desc')->paginate(4);
        } else {
            $posts = Post::orderBy('created_at', 'desc')->paginate(4);
        }
        // scopeを利用した検索
        $posts = Post::orderBy('created_at', 'desc')
        ->categoryAt($category_id) // ←★これ
        ->paginate(4);   // ページング

        return view('/dashboard', [
            'posts' => $posts, 
            'categories' => $categories, 
            'category_id'=>$category_id
        ],compact('post'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 皆の投稿一覧表示
    public function allpost(Post $post)
    {
        $posts=Post::orderBy('id','desc')->paginate(8);    // postテーブルに入ってるデータを全て取ってくる
        $user=auth()->user();  // ログインしているユーザの情報を取ってきて＄user変数に代入する
        $posts = Post::withCount('likes')->orderBy('id', 'desc')->paginate(4);
        $param = [
            'posts' => $posts,
        ];
        return view('post.allpost', compact('posts','user',$param));
    }

    /**
     * 登録画面(カテゴリー選択)
     */

    public function __construct()
    {
        $this->category = new Category();
    }

    public function categories(Request $request)
    {
        $categories = $this->category->get();
        return view('post.create', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category;
        $categories = $category->getLists()->prepend('選択', '');
     
        return view('bbs.create', ['categories' => $categories]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input=$request->validate([
            'image'=>'required|image|max:1024',
            'category_id'=>'required',
            'content'=>'required|max:512'
        ]);

        $post=new Post();
        $post->category_id=$input['category_id'];
        $post->content=$input['content'];
        $post->user_id=auth()->user()->id;

        if(request('image')){
            $original=request()->file('image')->getClientOriginalName();
            $name=date('Ymd_His').'_'.$original;
            $file=request()->file('image')->move('storage/images',$name);
            $post->image=$name;
        }

        $post->save();
        return back()->with('message','投稿されました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    // 詳細画面
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * 編集フォーム
     */
    public function edit($id)
    {
        $category = new Category;
        $categories = $category->getLists();
     
        $post = Post::findOrFail($id);
        return view('post.edit', ['post' => $post, 'categories' => $categories]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $input=$request->validate([
            'image'=>'required|image|max:1024',
            'category_id'=>'required',
            'content'=>'required|max:512'
        ]);

    // $post->image=$input['image'];
    $post->category_id=$input['category_id'];
    $post->content=$input['content'];

    if(request('image')){
        $original=request()->file('image')->getClientOriginalName();
        $name=date('Ymd_His').'_'.$original;
        $file=request()->file('image')->move('storage/images',$name);
        $post->image=$name;
    }

    $post->save();
    return redirect()->route('post.show',$post)->with('message','投稿を更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('mypage')->with('message','投稿を削除しました');
    }
    
    // いいね機能
    public function like(Request $request)
    {
        $user_id = Auth::user()->id; //1.ログインユーザーのid取得
        $post_id = $request->post_id; //2.投稿idの取得
        $already_liked = Like::where('user_id', $user_id)->where('post_id', $post_id)->first(); //3.
    
        if (!$already_liked) { //もしこのユーザーがこの投稿にまだいいねしてなかったら
            $like = new Like; //4.Likeクラスのインスタンスを作成
            $like->post_id = $post_id; //Likeインスタンスにpost_id,user_idをセット
            $like->user_id = $user_id;
            $like->save();
        } else { //もしこのユーザーがこの投稿に既にいいねしてたらdelete
            Like::where('post_id', $post_id)->where('user_id', $user_id)->delete();
        }
        //5.この投稿の最新の総いいね数を取得
        $post_likes_count = Post::withCount('likes')->findOrFail($post_id)->likes_count;
        $param = [
            'post_likes_count' => $post_likes_count,
        ];
        return response()->json($param); //6.JSONデータをjQueryに返す
    }

}
