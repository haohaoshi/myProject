<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index($data){
        echo 'index:'.$data;
    }
    public function test(){
        echo 'test:';
    }
    public function show()
    {
        echo 'show:';
        //var_dump(User::findOrFail($id));
        //return view('welcome');
    }
    public function login(){
        //echo '<pre>';
        //var_dump(config());
        //echo 'login';
        return view('login.login');
    }

}
