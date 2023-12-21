<?php

namespace app\http\middleware;

use think\facade\Session;

class Check
{
    public function handle($request, \Closure $next)
    {
        $uid = Session::get('uid_sign');

        if (empty($uid) && $_SERVER['REQUEST_URI'] != '/login' && $_SERVER['REQUEST_URI'] != '/tologin') {
            return redirect('/login');
        }

        return $next($request);
    }
}
