<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
//\think\Route::controller('test','index/test');
return [
    //全局规则
    '__pattern__' => [
        'name' => '\w+',
        'id'   => '\d+',
    ],
    //路由别名
    '__alias__' => [
        'test' => 'index/test',
    ],
    //没有匹配到路由时，访问的路由
//    '__miss__' => 'index/test/miss',

//    '[test]'     => [
//        ':id'   => ['index/test/index?type=1', ['method' => 'get']],
//        ':name' => ['index/test/index?type=2', ['method' => 'get']],
//    ],

//    'test/:id' => ['index/test/index?type=3',['method'=>'get']],
//    'test-<id>' => ['index/test/index?type=4',['method'=>'get']],
//    ':action/test' =>['index/test/:action',['method'=>'get']]


];

//Route::controller('test','index/test');
