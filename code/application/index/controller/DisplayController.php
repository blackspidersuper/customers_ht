<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\facade\Request;
use think\facade\Session;
use app\index\model\DisplayModel;

class DisplayController extends Controller
{
     //数据展示页面
     public function show_display_page()
     {
         return $this->fetch('display/display');
     }

}
