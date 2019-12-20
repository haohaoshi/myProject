<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019\10\29 0029
 * Time: 15:00
 */
//调用index模块下不存在的控制器和方法时调用
namespace app\index\controller;
use app\common\controller\Base;
use think\Request;

class Error extends Base
{
    //预先执行的控制器
    protected $beforeActionList = [
        'index'=>['except'=>'index']//除去index
    ];

    public function index(){
        $param = Request()->controller();
        dump('调用空控制器:'.$param);
    }
    public function _empty($param){
        dump('调用空的方法:'.$param);
    }
}