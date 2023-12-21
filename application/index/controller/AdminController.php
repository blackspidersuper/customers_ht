<?php

namespace app\index\controller;

use think\Controller;
use think\facade\Session;
use think\facade\Request;
use app\index\model\AdminModel;

class AdminController extends Controller
{
    //登录页面
    public function login()
    {
        return $this->fetch('admin/login');
    }

    //登录接口
    public function tologin()
    {
        $postdata = array(
            'uname' => Request::param('username', ''),
            'passwd' => Request::param('password', ''),
        );

        $mod = new AdminModel();

        //登录校验
        $res = $mod->user_check($postdata);

        return json($res);
    }

    //退出登录
    public function logout()
    {
        Session::clear();
        return json(['code' => 1, 'msg' => '退出成功']);
    }
}
