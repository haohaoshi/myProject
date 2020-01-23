<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019\12\26 0026
 * Time: 13:38
 */

namespace app\common\controller;


use think\Controller;

class Base extends Controller
{
    //空操作
    public function _empty()
    {
        $this->error('该页面不存在！');
    }
}