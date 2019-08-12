<?php
namespace app\admin\controller;


use think\Config;

class Index extends Base
{
    public function index($name,$id=0)
    {
        //Config::load(ROOT_PATH.'config/app.php');
        //Config::parse(ROOT_PATH.'config/');
        //Config::selfLoad(ROOT_PATH.'config/','','config');
        //dump(Config::get());
        //dump(APP_TEST);
        dump($name);
        dump($id);

        //return view('index/index');
    }
    public function dit(){

    }
    public function test(){
        $ary = ['img'=>'<img src="http://cms.3gcloud.cnfol.com/uploads/e09004a4930c51c68526b8c4d2cc3fa9.jpg"/>'];
        $url = 'http://collect.cms.cnfol.com/index.php/manager/api/uploadHtmlImg';
        $res = curlPost($url,$ary);
        dump($res);
    }
}
