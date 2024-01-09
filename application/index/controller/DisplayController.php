<?php

namespace app\index\controller;

use think\Controller;
use app\index\model\DisplayModel;
use app\index\model\Display1Model;
use think\facade\Session;
use think\facade\Request;

class DisplayController extends Controller
{
    //图展示页面
    public function show_display_page()
    {
        return $this->fetch('display/display');
    }

    //数据展示数据
    public function show_list_display()
    {
        $uid = Session::get('uid_sign'); //唯一标识uid

        $mod = new DisplayModel();
        $res = $mod->show_list_display($uid);
        return json($res);
    }

    //数据展示页面
    public function data_display_page()
    {
        return $this->fetch('display/display_data');
    }

    //数据展示1页面
    public function data_display_page1()
    {
        return $this->fetch('display/display_data1');
    }

    //下载
    public function down_list()
    {
        $time = time();

        $type_pallet = Request::param('type_pallet', '');  //下载平台
        $start_time = Request::param('start_time', '');  //开始时间
        $end_time = Request::param('end_time', '');  //结束时间
        $reply_num = Request::param('reply_num', 10); //重复次数
        $key = Request::param('key', ''); //下载类型

        $uid = Request::param('uid_id', ''); //唯一标识uid
        $uid = empty($uid) ? Session::get('id') : $uid; //唯一标识uid

        $today = strtotime('today 00:00:00');  //获取今天0点的时间
        $five_time =  $today  - (86400 * 10); //5天前的时间

        //转换时间格式
        $last_start = empty($start_time) ? $five_time : strtotime($start_time);
        $last_end = empty($end_time) ? $time : strtotime($end_time);


        if (!in_array($type_pallet, array('bdds', 'bdinfo', 'douyin', 'kuaishou'))) { //如果不在这个数组中，那么就直接返回false
            return json(array('code' => '1', 'msg' => '参数错误'));
        }

        if (!in_array($key, array('imei', 'oaid', 'idfa'))) { //如果不在这个数组中，那么就直接返回false
            return json(array('code' => '1', 'msg' => '参数错误'));
        }

        $mod = new DisplayModel();
        $res = $mod->down_list($uid, $type_pallet, $key, $last_start, $last_end, $reply_num);
        return json($res);
    }

     //下载
     public function down_list1()
     {
         $time = time();
 
         $type_pallet = Request::param('type_pallet', '');  //下载平台
         $start_time = Request::param('start_time', '');  //开始时间
         $end_time = Request::param('end_time', '');  //结束时间
         $key = Request::param('key', ''); //下载选择类型
 
         $uid = Request::param('uid_id', ''); //唯一标识uid
         $uid = empty($uid) ? Session::get('id') : $uid; //唯一标识uid
 
         $today = strtotime('today 00:00:00');  //获取今天0点的时间
         $five_time =  $today  - (86400 * 10); //5天前的时间
 
         //转换时间格式
         $last_start = empty($start_time) ? $five_time : strtotime($start_time);
         $last_end = empty($end_time) ? $time : strtotime($end_time);
 
 
         if (!in_array($type_pallet, array('bdds', 'bdinfo', 'douyin', 'kuaishou'))) { //如果不在这个数组中，那么就直接返回false
             return json(array('code' => '1', 'msg' => '参数错误'));
         }
 
         $mod = new Display1Model();
         $res = $mod->down_list($uid, $type_pallet, $key, $last_start, $last_end);
         return json($res);
     }
}
