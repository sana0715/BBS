<?php
// 私の情報コントローラー
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;

class UserController extends Controller
{  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // プロフィール表示
    public function index()
    {
        $user = Auth::user();
        return view('user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 作成←使わない
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
    // 作成保存←使わない
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
    // 詳細画面
    public function show(User $user)
    {
        return view('user.show', compact('user'));
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // 編集画面
    public function edit($id)
    {
        $user = User::find($id);
        // $user = User::findOrFail($id);
        return view('user.edit',['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // 更新
    public function update(Request $request, User $user)
    {
        $input=$request->validate([
            'image'=>'image|max:1024',
            'name'=>'required',
            'email'=>'required|max:512'
        ]);

        // $post->image=$input['image'];
        $user->name=$input['name'];
        $user->email=$input['email'];

        if(request('image')){
            $original=request()->file('image')->getClientOriginalName();
            $name=date('Ymd_His').'_'.$original;
            $file=request()->file('image')->move('storage/images',$name);
            $user->image=$name;
        }

        $user->save();
        return redirect()->route('user.show',$user)->with('message','アカウント情報を更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // 削除
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('login')->with('message','アカウントを削除しました');
    }
}
