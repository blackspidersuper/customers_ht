<?php

namespace app\http\middleware;

use think\facade\Session;

class Check
{
    public function handle($request, \Closure $next)
    {
        $uid = Session::get('uid_sign');

        $requestUri = ltrim($_SERVER['REQUEST_URI'], '/'); 
        
        $arr = array('douyin_table_all','baidu_table_check','baidu_table_info','kuaishou_table_all','gdt_click_table_all','gdt_exposure_table_all','gdt_follow_table_all','gdt_effect_table_all','gdt_fans_table_all');
        
        if (!in_array($requestUri, $arr)) {
             if (empty($uid) && $_SERVER['REQUEST_URI'] != '/login' && $_SERVER['REQUEST_URI'] != '/tologin') {
                return redirect('/login');
            }
        };

        return $next($request);
    }
}
