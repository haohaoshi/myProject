<?php
namespace app\admin\controller;

use app\admin\model;
use app\common\controller\Base;
use think\Config;
//use think\Model;

class Index extends Base
{
    public $model;
    public function _initialize()
    {
        //$this->model = model('index');
        $this->model = new model\IndexModel();
    }

    public function index($name='null',$id=0)
    {
        //Config::load(ROOT_PATH.'config/app.php');
        //Config::parse(ROOT_PATH.'config/');
        //Config::selfLoad(ROOT_PATH.'config/','','config');
        //dump(Config::get());
        //dump(APP_TEST);
//        dump($name);
//        dump($id);
        $data = array();

        //$this->assign('data',$data);
        return view('index/index');
    }
    public function details(){
        return view('index/details');
    }
    public function test(){
        $res = $this->model->getList();
        dump(\config());
    }
}
