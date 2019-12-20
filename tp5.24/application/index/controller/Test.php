<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019\10\24 0024
 * Time: 9:57
 */

namespace app\index\controller;

use function foo\func;
use think\Config;
use app\index\controller\Base;
use think\Request;
use Think\Route;
use think\Url;

//load_trait('controller/Jump');
class Test extends Base
{
    private $adminModel;
    //use \traits\controller\Jump;
    public function __construct()
    {
        $this->adminModel = model('admin');
    }
//    public function __construct()
//    {
//        echo 'construct';
////        echo APP_PATH.'../config/config_test.php';
////        Config::load(APP_PATH.'../config/config_test.php');
//    }
    //前置函数执行
    protected $beforeActionList = [
        'first',
        'second' =>  ['except'=>'hello'],//除...之外
        'three'  =>  ['only'=>'hello,data'],//仅仅
    ];
    protected function first()
    {
        echo 'first<br/>';
    }

    protected function second()
    {
        echo 'second<br/>';
    }

    protected function three()
    {
        echo 'three<br/>';
    }

    public function index($year=2019,$month=1,$day=1){
//        $userid = 2213;
        $str = " {$year}年{$month}月{$day}日";
//        $ary = '';
//        $this->result($ary,1,'trait 引入','view');
//        dump('index');
//        $index = controller('index/index');
//        $index->index();
//        return redirect('save')->remember();
//        $this->redirect('test/save');
//        return view('index');
//        $request = Request::instance();
//        dump($request->param());
        //$res = request()->sqlF($userid);
        db2::table();
        echo($str);
    }


    public function select(){
        $where = ['nickname'=>['like','小溪%']];
        $res = $this->adminModel->all($where);
//        foreach ($res as $item){
//            $item->ranking;
//        }
        dump($res->append(['ranking'])->toArray());
    }
    public function max(){
        $res = $this->adminModel->max('status');
        dump($res);
    }
    //查询单个
    public function get(){
        $where = ['nickname'=>['like','小溪%']];
        $res = $this->adminModel->get($where);
        dump($res->toArray());
        dump($res->append(['ranking'])->toArray());
        dump($res->toJson());
    }
    //获取器
    public function getter(){
        $where = ['nickname'=>['like','小红%']];
        $res = $this->adminModel->get($where);
        $status = $res->status;//单独取出获取器内容
        dump($status);
        $status =  $res->getData('status');// 获取原始字段数据
        dump($status);
        $ranking = $res->ranking;//单独取出获取器内容（不存在原字段）
        dump($ranking);
        $resAry = $res->toArray();//自动将获取器的内容替换进去
        dump($resAry);
        $resAry = $res->getData();//获取原始数据
        dump($resAry);
    }

    //返回某个列的所有值
    public function column(){
        $where = ['nickname'=>['like','小溪%']];
        $res = $this->adminModel->where($where)->column('nickname');
        dump($res);
    }
    //返回某个列的单个值
    public function value(){
        $where = ['nickname'=>['like','小溪%']];
        $res = $this->adminModel->where($where)->value('nickname');
        dump($res);
    }

    public function update(){
        $data = [
            //'nickname' => '李玉',
            //'account' => 'ppp',
            'password' => 'ppp',
            //'login_time' => date('Y-m-d H:i:s'),
        ];
        dump($data);
        $res = $this->adminModel->isUpdate(true)->allowField(true)->save($data,['nickname'=>'李玉']);//allowField(true)自动去掉没有字段
        dump($res);
    }

    public function save(){
        $data = [
            'nickname' => '小溪'.mt_rand(1,99999),
            'account' => 'fff'.mt_rand(1,99999),
            'password' => 'fff'.mt_rand(1,99999),
            'create_time' => date('Y-m-d H:i:s'),
        ];
        dump($data);
        $res = $this->adminModel->isUpdate(false)->allowField(true)->save($data);//allowField(true)自动去掉没有字段
        dump($res);
    }

    public function saveAll(){
        $data = [
            ['nickname' => '小溪'.mt_rand(1,99999),'account' => 'act'.mt_rand(1,99999),'password' => 'pad'.mt_rand(1,99999),'create_time' => date('Y-m-d H:i:s')],
            ['nickname' => '小溪'.mt_rand(1,99999),'account' => 'act'.mt_rand(1,99999),'password' => 'pad'.mt_rand(1,99999),'create_time' => date('Y-m-d H:i:s')],
        ];
        dump($data);
        $res = $this->adminModel->isUpdate(false)->allowField(true)->saveAll($data);
        dump($res);
    }

    public function delete(){
        //model开启了软删除所以不会真的删除数据，除非第二个参数添加true，delete就直接delete(true)
        $res = $this->adminModel::destroy(function ($query){//闭包形式
            //$query->where('nickname','like','小溪%');
            $query->where(['nickname'=>['like','小溪%']]);
        });
        dump($res);
    }

    public function miss(){
        dump('miss');
    }

    //调用不存在的方法时
    public function _empty($param){
        dump($param);
        dump('empty');
    }

}