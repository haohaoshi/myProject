<?php
namespace app\admin\controller;

use think\Request;

class Index extends Base
{
    public function index()
    {
        dump(openssl_get_cert_locations());
    }

    public function login(){
        return view();
    }
}
