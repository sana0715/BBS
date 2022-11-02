<?php
// 管理者ログアウト
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminLogoutController extends Controller
{
    //
    function logout(Request $request){
        $request->session()->forget("auth_admin");
        return redirect("admin");
      }
}
