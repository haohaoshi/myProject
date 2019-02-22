<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('/user','UserController@index')->name('user.name');

Route::get('users/{user}', function (App\User $user) {
    //echo'111';
    /*// 获取当前路由实例
    $route = Route::current();
    // 获取当前路由名称
    $name = Route::currentRouteName();
    // 获取当前路由action属性
    $action = Route::currentRouteAction();*/
    return $user;
})->middleware('token');

//文件上传
Route::post('file/upload', function(\Illuminate\Http\Request $request) {
    //dump($_FILES);
    //dump($request->file());
    //dump($request);
    //dump($request->file('photo')->isValid());
    if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
        $photo = $request->file('photo');
        $extension = $photo->extension();
        //$store_result = $photo->store('photo');
        $store_result = $photo->storeAs('photo', 'test.jpg');
        $output = [
            'extension' => $extension,
            'store_result' => $store_result
        ];
        print_r($output);exit();
    }
    exit('未获取到上传文件或上传过程出错');
})->name('file.upload');


Route::get('down',function(){
    //查看图片
    return response()->file(storage_path('app/photo/test.jpg'));
    //下载图片
    //return response()->download(storage_path('app/photo/test.jpg'), '测试图片.jpg');
});

Route::get('view',function(){

    $data = ['name'=>'admin'];
    return view()->first(['file', 'file'], $data);
});



/*Route::get('users/{user}', function (App\api\UserModel $user) {
    return $user->name;
});*/

//Route::get('users/{user}','');
//Route::resource('user','UserController');
//Route::get('/','UserController@');
