<?php

namespace app\index\model;

use think\facade\Session;
use think\Model;
use think\Db;

class AdminModel extends Model
{
    protected $paskey1 = 'm4jWe2dazUAtV2GIeN1pDaWMSJlJbbBD';

    /**
     * 校验登录信息
     *
     * @param array $postdata
     * @return array $run
     */
    public function user_check($postdata)
    {
        $uname = $postdata['uname'];
        $sql = "SELECT `id`,`uname`,`name`,`passwd`,`uid_sign`,`created` FROM `user` WHERE `uname`='" . $uname . "'";
        $userinfo = Db::query($sql);

        $password_key2 = Db::getConfig('password');

        $run = array('code' => '0', 'msg' => '账号或者密码不正确');

        //账号是否存在（混淆一波视听，免得暴库）
        if (empty($userinfo)) {
            return $run;
        }

        //密码不能直接放数据库
        $psw = md5($this->paskey1.$userinfo[0]['created'] . $postdata['passwd'] . $password_key2 );
        if ($userinfo[0]['passwd'] == $psw) {
            Session::set('uname', $userinfo[0]['uname']);
            Session::set('name', $userinfo[0]['name']);
            Session::set('id', $userinfo[0]['id']);
            Session::set('uid_sign', $userinfo[0]['uid_sign']);
            return array('code' => '1', 'msg' => '校验成功');
        } else {
            return $run;
        }
    }
}
