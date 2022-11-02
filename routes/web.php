<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\bbsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// get = 表示

// laravelのトップページ⭕️
Route::get('/', function () {
    return view('welcome');
});

// // マイページトップ⭕️
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// カテゴリー別投稿
Route::get('/dashboard', [PostController::class, 'dashboard'])->name('dashboard');

// 皆の投稿一覧
Route::get('/allpost', [PostController::class, 'allpost'])->name('allpost');

// 詳細画面の取得
Route::resource('post', 'PostController', ['only' => ['index', 'show']]);

// 私の投稿一覧
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('mypage');

// 投稿機能
// 追加投稿(新規投稿)、編集画面、更新、削除、一覧表示、詳細画面
Route::resource('/post','PostController');

// カテゴリー表示
Route::get('/create', [PostController::class, 'categories'])->name('categories');

// ユーザー情報
Route::resource('/user','UserController');

// ユーザー投稿の一覧表示画面
Route::resource('/users', 'UsersController', ['only' => ['show']]);

// フォロー機能
Route::post('users/{user}/follow', [App\Http\Controllers\UsersController::class, 'follow'])->name('follow');
Route::delete('users/{user}/unfollow',[App\Http\Controllers\UsersController::class, 'unfollow'])->name('unfollow');

// フォロー一覧
Route::get('/follow_list', [App\Http\Controllers\UsersController::class, 'following'])->name('follow_list');

// いいね機能
Route::post('/like', 'PostController@like')->name('post.like');


// 管理者ログイン
Route::get('/mgt_login', [UserController::class, 'mgtLogin'])->name('mgt_login');

//↓追加
Route::group(['middleware' => ['admin.auth']], function () {
    Route::get('/admin', 'admin\AdminMainController@show');
    Route::post('/admin/logout', 'admin\AdminLogoutController@logout');
});

Route::get('/admin/allposts', 'admin\AdminMainController@allposts');
Route::get('/admin/allusers', 'admin\AdminMainController@allusers');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', 'admin\AdminLoginController@showForm');
    Route::post('/login', 'admin\AdminLoginController@login');
});


