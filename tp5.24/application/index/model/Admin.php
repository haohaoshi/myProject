<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019\10\31 0031
 * Time: 9:47
 */

namespace app\index\model;


use function MongoDB\BSON\fromJSON;
use traits\model\SoftDelete;

class Admin extends Base
{
    use SoftDelete;//引入软删除，执行delete和destroy不会进行删除，而进行对应的时间更新
    protected $deleteTime = 'delete_time';//定义删除时间字段，表中存在，删除后自动更新时间戳进去，保存原有数据

    protected $dateFormat = false;//防止时间自动转换（如果表中存放的不是时间戳会报错，所以关闭）

    //自动完成
    protected $auto = [];//每次操作所要自动完成的选项
    protected $update = ['login_time'];//更新时自动完成的选项
    protected $insert = ['status'];//插入时自动完成的选项
    //自动完成和获取器的区别：自动完成不需要参数，获取器是将当前的数值进行改变

    protected $resultSetType = 'collection';//添加了这个属性，toArray()才能对二维数组生效，不然只能对一维数组生效

    protected static function init(){
        Admin::before_insert();//注册插入之前事件
        Admin::after_insert();//注册插入之后事件
    }

    //获取器，已存在的字段
    protected function getStatusAttr($value)
    {
        $type = [1=>'正常',2=>'禁用',3=>'审核',4=>'待审核'];
        $val = !isset($type[$value])?'未知':$type[$value];
        return ['key'=>$value,'val'=>$val];
    }
    //获取器，不存在的字段
    protected function getRankingAttr($value,$data){
        $type = [1=>'第一名',2=>'第二名',3=>'第三名',4=>'第四名',5=>'第五名'];
        $val = !isset($type[$data['u_id']])?'未知':$type[$value];
        //$data['ranking'] = $val;
        return $val;
    }
    //修改器，在写入数据时操作
    protected function setNicknameAttr($value){
        return $value.'修改器';
    }

    //自动完成
    protected function setStatusAttr(){
        return 99;
    }
    protected function setLoginTimeAttr(){
        return time();
    }

    //执行插入之前操作，
    protected static function before_insert(){
        Admin::event('before_insert',function ($data){
            dump('------before_insert---status----');
            dump($data->nickname);
            dump($data['account']);
            dump('------before_insert---end----');
            return true;
        });
    }
    //执行插入之后操作
    protected static function after_insert(){
        Admin::event('after_insert',function($data){
            dump('------after_insert---status----');
            dump($data->u_id);
            dump($data['nickname']);
            Admin::log();
            dump('------after_insert---end----');
        });
    }

    protected static function log(){
        dump('日志记录');
    }














}