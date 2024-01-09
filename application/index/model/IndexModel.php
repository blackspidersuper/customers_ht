<?php

namespace app\index\model;

use think\facade\Session;
use think\Model;
use think\Db;

class IndexModel extends Model
{
    /**
     * 获取该用户的页面
     *
     * @param string $powers
     * @return array $run
     */
    public function admin_powers($username)
    {
        $id = Session::get('id');

        $push_data = $this->push_data;

        //查询用户存不存在
        $sql = "SELECT `uname` FROM `user` WHERE `id` = '" . $id . "'";
        $res = Db::query($sql);

        if (empty($res)) {
            return array('code' => '0', 'msg' => '用户不存在');
        }

        return $push_data;
    }


    //用户信息
    public function user_info()
    {
        $id = Session::get('id');

        $sql = "SELECT `id` FROM `user` WHERE `id` = '{$id}'";
        $res = Db::query($sql);

        if (empty($res)) {
            return array();
        }

        $domain_name = $_SERVER['HTTP_HOST']; //当前域名

        return array('username' => Session::get('uname'), 'uid_sign' => Session::get('uid_sign'),'domain_name'=>$domain_name);
    }



    //传给前端的
    public $push_data = array(
        "homeInfo" => array(
            "title" => "首页",
            "href" => "/show"
        ),
        // "logoInfo" => array(
        //     "title" => "获客系统",
        //     "image" => "/static/linkdoc/iconLogo.png"
        // ),
        "logoInfo" => array(
            "title" => "系统",
            "image" => "/",
            "href" => "/"
        ),
        "menuInfo" => array(
            array(
                "title" => "管理",
                "icon" => "fa fa-address-book",
                "href" => "",
                "target" => "_self",
                "child" => array(
                    array(
                        "title" => "项目管理",
                        "icon" => "fa fa-window-maximize",
                        "child" => array(
                            array(
                                "title" => "监测链接",
                                "href" => "/show",
                                "icon" => "fa fa-list-alt",
                                "target" => "_self",
                            )
                        )
                    ),
                    array(
                        "title" => "报表统计",
                        "icon" => "fa fa-area-chart",
                        "child" => array(
                            array(
                                "title" => "图展示",
                                "href" => "/display/show_display_page",
                                "icon" => "fa fa-line-chart",
                                "target" => "_self",
                            ),
                            array(
                                "title" => "数据展示",
                                "href" => "/display/data_display_page",
                                "icon" => "fa fa-line-chart",
                                "target" => "_self",
                            ),
                            array(
                                "title" => "数据展示1",
                                "href" => "/display/data_display_page1",
                                "icon" => "fa fa-line-chart",
                                "target" => "_self",
                            )
                        )
                    ),
                )
            )
        )
    );
}
