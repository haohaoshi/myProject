<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('cookie/add', function () {
    $minutes = 24 * 60;
    return response('欢迎来到 Laravel 学院')->cookie('name', '学院君', $minutes);
});
Route::get('cookie/get', function(\Illuminate\Http\Request $request) {
    $cookie = $request->cookie('name');
    dd($cookie);
});

Route::get('file',function(){
    return view('file');
});

//Route::view('/','welcome',['name'=>'ljz']);
/*Route::middleware('user')->group(function(){

});

//路由命名
Route::get('user/{id?}/{name?}', function ($id = 1,$name='admin') {
    return "用户".$name."ID: " . $id;
})->name('user.profile');

//路由路径前缀
Route::prefix('test')->group(function () {
    Route::get('/', function () {
        return 'test.index';
    })->name('test.index');
    Route::get('users', function () {
        return 'test.users';
    })->name('test.users');
});

// 路由命名+路径前缀
Route::name('user.')->prefix('user1')->group(function () {
    Route::get('{id?}', function ($id = 1) {
        // 处理 /user/{id} 路由，路由命名为 user.show
        return "用户ID: " . $id;
    })->name('show');
    Route::get('posts', function () {
        // 处理 /user/posts 路由，路由命名为 user.posts
    })->name('posts');
});*/

