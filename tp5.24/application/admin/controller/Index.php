<?php
namespace app\admin\controller;

use think\Request;

class Index extends Base
{
    public function index()
    {
        try{
            $a = 10%0;
        }catch(\Error $e){
            //trace($e->getMessage());
            dump($e->getMessage());
            dump($e->getFile());
            dump($e->getLine());
        }
    }

    public function login()
    {

        return $this->fetch();
    }

    public function captcha($id = '')
    {
        return captcha($id);
    }
}
