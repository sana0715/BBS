<?php
// 管理者ログイン
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    //
    // loginがgetで送信された時：showForm()を実行する
    // loginがpostで送信された時：login()を実行する
    function showForm(){
        return view('admin.login');
    }

    function login(Request $request){
        $user_name = $request->input('user_name');
        $password = $request->input('password');

        if($user_name == 'boxing' && $password == 'testtest'){
            $request->session()->put("auth_admin", true);
            return redirect('admin');
        }

        return redirect('admin/login');
    }
}
