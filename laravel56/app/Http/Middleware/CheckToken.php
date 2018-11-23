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
    public function handle($request, Closure $next)
    {
        //$response = $next($request);
        //var_dump($response);die;

        if($request->input('token') != 'key123'){
            return redirect()->to('http://localhost/github/laravel56/server.php/user/login');
        }
        return $next($request);


        // 执行动作
        //return $response;
    }
}
