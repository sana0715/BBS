<?php
// 皆の個別のアカウント表示
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use App\Models\Follow;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user,Request $request)
    {
        //
        $user = User::find($user->id); //idが、リクエストされた$userのidと一致するuserを取得
        $user_flg = $request->path();  // $requestでパスを取得
        $user_flg = preg_replace('/[^0-10000]/', '', $user_flg);
        $posts = Post::where('user_id', $user->id) //$userによる投稿を取得
            ->orderBy('created_at', 'desc') // 投稿作成日が新しい順に並べる
            ->paginate(10); // ページネーション; 
        return view('users.show', [
            'user_name' => $user->name, // $user名をviewへ渡す
            'posts' => $posts, // $userの書いた記事をviewへ渡す
            'user' => $user,
            'user_flg' => $user_flg
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function follow(User $user)
   {
       $follower = auth()->user();
       // フォローしているか
       $is_following = $follower->isFollowing($user->id);
       if(!$is_following) {
           // フォローしていなければフォローする
           $follower->follow($user->id);
           return back();
       }
   }
 
   // フォロー解除
   public function unfollow(User $user)
   {
       $follower = auth()->user();
       // フォローしているか
       $is_following = $follower->isFollowing($user->id);
       if($is_following) {
           // フォローしていればフォローを解除する
           $follower->unfollow($user->id);
           return back();
       }
    }

}
