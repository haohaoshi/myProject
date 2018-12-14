<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class UserController extends Controller
{
    /**/
    public function index(){
        //log_ljz(111);
        //return view('index.index');
        $res = $this->middleware('UserToken')->except('info');
        dump($res);
    }
    public function login(){
        return view('index.login');
    }
    public function show()
    {
        echo 'show:';
        //var_dump(User::findOrFail($id));
        //return view('welcome');
    }

}
