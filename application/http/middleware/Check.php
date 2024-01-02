<?php

namespace app\http\middleware;

use think\facade\Session;

class Check
{
    public function handle($request, \Closure $next)
    {
        $uid = Session::get('uid_sign');


        $arr = array('/douyin_table_all', '/baidu_table_check', '/baidu_table_info', '/kuaishou_table_all', '/gdt_click_table_all', '/gdt_exposure_table_all', '/gdt_follow_table_all', '/gdt_effect_table_all', '/gdt_fans_table_all');

        $str =$_SERVER['REQUEST_URI'];
        $position = strpos($str, '?'); // 查找问号的位置  
        if ($position !== false) {
            $result = substr($str, 0, $position); // 截取字符串直到问号的位置  
        } else {
            $result = $str; // 如果没有找到问号，则保留原始字符串  
        }

        if (empty($uid) && $_SERVER['REQUEST_URI'] != '/login' && $_SERVER['REQUEST_URI'] != '/tologin') {
            if (!in_array($result, $arr)) {
                return redirect('/login');
            }
        }


        return $next($request);
    }
}
