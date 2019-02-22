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
    /**
     * 处理输入请求
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //var_dump($request->route()->named());
        if ($request->route()->named('profile')) {

        }

        return $next($request);
    }
}