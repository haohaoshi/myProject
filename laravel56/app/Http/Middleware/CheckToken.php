<?php

namespace App\Http\Middleware;

use Closure;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next )
    {
        //先执行判断，再执行路由
        //echo $str;
        if($request->input('token') != 'key123'){
            return redirect()->to('http://localhost/github/laravel56/server.php');
        }
        return $next($request);

        //先执行路由，再执行判断
        /*$response = $next($request);
        echo 222;
        // 执行动作
        return $response;*/
    }
}
