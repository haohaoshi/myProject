<?php
/**
 * Created by PhpStorm.
 * User: Lujz
 * Date: 2018\12\4 0004
 * Time: 14:15
 */

namespace App\Http\Middleware;


class UserToken
{
    public function info(){
        return array('name'=>'li','age'=>'23');
    }
}