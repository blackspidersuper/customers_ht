<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

//Route::rule('路由表达式','路由地址','请求类型');
// Route::快捷方法名('路由表达式','路由地址');

Route::get('/', 'Index/index');//主页
Route::get('/admin_page', 'Index/admin_page');//获取菜单列表
Route::get('/show', 'Index/show');//首页


Route::get('/login', 'Admin/login');//登录
Route::post('/tologin','Admin/tologin'); //登录检测
Route::get('/logout','Admin/logout'); //退出登录

Route::get('/display/show_display_page','Display/show_display_page'); //数据展示界面

return [

];
