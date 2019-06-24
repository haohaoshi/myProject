<?php
namespace app\admin\controller;


use think\Config;

class Index extends Base
{
    public function index()
    {
        //Config::load(ROOT_PATH.'config/app.php');
        //Config::parse(ROOT_PATH.'config/');
        //Config::selfLoad(ROOT_PATH.'config/','','config');
        dump(Config::get());

        //return view('index/index');
    }
    public function test(){
        $str = '<li><a href="http://roadshow.cnfol.com/show/13637"   target="_blank"><img 
src="http://images.cnfol.com/file/201407/cl_201407210845038313.jpg" alt="陈龙">陈龙<br><em class="ToBlue">13日09：30</em></a>
<li><a href="http://roadshow.cnfol.com/show/13638" target="_blank"><img 
src="http://images.cnfol.com/file/201505/1_201505081616455402.jpg" alt="李杰涛">Michael<br><em class="ToBlue">13日15：00</em></a>
<li><a href="http://roadshow.cnfol.com/show/13639" target="_blank"><img 
src="http://images.cnfol.com/file/201507/1_201507241501277111.jpg" alt="斯晨怡">斯晨怡<br><em class="ToBlue">13日20：00</em></a></li>';

        preg_match_all('/<a href="(.*)"[^>]*>.*src="(.*)"[^>]*>(.*)<br><em[^>]*>(.*)<\/em>/isU',$str,$res);
        dump($res);

        preg_match('/<a href="(.*)"[^>]*>/is',$str,$res);
        //dump($res);
    }
}
