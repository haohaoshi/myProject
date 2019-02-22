<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class UserController extends Controller
{
    /**/
    public function index(Request $request){
        $name1 = $request->input('name');
        dump($name1);
//        $name2 = $request->query('name');
//        dump($name2);
//        $name3 = $request->name;
//        dump($name3);

        $name = $request->flashOnly('name');
        dump($name);
        $name_old = $request->old('name');
        dump($name_old);




        //log_ljz(111);
        //return view('index.index');
        /*$res = $this->middleware('UserToken')->except('info');
        dump($res);*/
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
