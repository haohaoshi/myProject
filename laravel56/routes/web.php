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
Route::view('/','welcome',['name'=>'ljz']);
/*Route::get('hello',function (){
    return view('hello',['name'=>'ljz']);
});*/

Route::get('/hello/{msg}',function($msg){
    return view('hello',['msg'=>$msg,'name'=>'ljz']);
});

/*Route::get('user/profile', function () {
    // 通过路由名称生成 URL
    return 'my url: ' . route('profile');
})->name('profile');*/



Route::get('redirect', function() {
    // 通过路由名称进行重定向
    return redirect()->route('profile');
});

//Route::resource('user','UserController');
Route::get('/user/index/{name}','UserController@index')->name('user.index');


Route::get('/user/login','UserController@login')->name('user.login')->middleware('token');
/*Route::get('/user/login',function(){

});*/

Route::get('/user/test','UserController@test')->name('user.test');

/*Route::get('user/{id}/profile', function ($id) {
    $url = route('profile', ['id' => $id]);
    return $url;
})->name('profile');*/

//Route::view('/hello', 'hello',['name'=>'ljz']);
//Route::view('/hello', 'hello', ['name' => '学院君']);

Route::match(['get', 'post'], 'foo', function () {
    return 'This is a request from get or post';
});

Route::any('bar', function () {
    return 'This is a request from any HTTP verb';
});

Route::get('form',function (){
    return '<form method="post" action="http://localhost/github/laravel56/server.php/foo">'.csrf_field().'<button type="submit">提交</button></form>';
});

