<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019\10\29 0029
 * Time: 16:13
 */
namespace app\index\controller\multi;

use think\Url;

class Index extends Base
{
    public function index(){
        dump('调用多级控制器:'.Url::build());
    }
}