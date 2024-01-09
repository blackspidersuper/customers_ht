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
Route::get('/user_info', 'Index/user_info'); //用户信息


Route::get('/display/show_display_page','Display/show_display_page'); //图界面

Route::get('/display/data_display_page','Display/data_display_page'); //数据界面

Route::get('/display/data_display_page1','Display/data_display_page1'); //数据界面


Route::get('/display/show_list_display','Display/show_list_display'); //数据展示数据
Route::post('/display/down_list','Display/down_list'); //下载数据数据

Route::get('/display/down_list1','Display/down_list1'); //下载数据数据

Route::rule('/douyin_table_all','Monitor/douyin_table','GET|POST'); //抖音获取监测链接信息，插入到数据库
Route::rule('/baidu_table_check', 'Monitor/baidu_table_check','GET|POST'); //百度-大搜基木鱼，获取监测链接信息，插入到数据库
Route::rule('/baidu_table_info', 'Monitor/baidu_table_info','GET|POST'); //百度-信息流，获取监测链接信息，插入到数据库
Route::rule('/kuaishou_table_all',  'Monitor/kuaishou_table_all','GET|POST'); //快手获取监测链接信息，插入到数据库
Route::rule('/gdt_click_table_all', 'Monitor/gdt_click_table_all','GET|POST'); //广点通，点击获取监测链接信息，插入到数据库
Route::rule('/gdt_exposure_table_all', 'Monitor/gdt_exposure_table_all','GET|POST'); //广点通，曝光监测获取监测链接信息，插入到数据库
Route::rule('/gdt_effect_table_all',  'Monitor/gdt_effect_table_all','GET|POST'); //广点通，效果获取监测链接信息，插入到数据库
Route::rule('/gdt_fans_table_all',  'Monitor/gdt_fans_table_all','GET|POST'); //广点通，企业微信加粉效果转发获取监测链接信息，插入到数据库
Route::rule('/gdt_follow_table_all',  'Monitor/gdt_follow_table_all','GET|POST'); //广点通，公众号关注效果转发获取监测链接信息，插入到数据库


return [

];
