<?php

namespace app\index\controller;

use think\Controller;
use think\facade\Session;
use app\index\model\IndexModel;

class IndexController extends Controller
{
    //首页，（只有导航菜单栏）
    public function index()
    {
        // 模板变量赋值
        $this->assign('username', Session::get('uname'));
        return $this->fetch('/index');
    }

    //菜单树(给首页使用的api)
    public function admin_page()
    {
        $mod = new IndexModel();
        return json($mod->admin_powers(Session::get('uname')));
    }

    //首页（一进来就显示）
    public function show()
    {
        return $this->fetch('admin/index');
    }

    //用户信息
    public function user_info()
    {
        $mod = new IndexModel();
        return json($mod->user_info());
    }
}
