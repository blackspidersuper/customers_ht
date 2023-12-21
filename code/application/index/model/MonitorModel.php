<?php

namespace app\index\model;

use think\facade\Session;
use think\Model;
use think\Db;

class MonitorModel extends Model
{
    protected $dy_table = 'dy_table'; //抖音
    protected $bd_check_table = 'baidu_serach_check'; //百度-大搜基木鱼
    protected $bd_info_table = 'baidu_info'; //百度-信息流
    protected $ks_table = 'ks_table'; //快手
    protected $gdt_click_table = 'gdt_click_table'; //广点通-点击监测
    protected $gdt_expo_table = 'gdt_expo_table'; //广点通-曝光监测
    protected $gdt_effect_table = 'gdt_effect_table'; //广点通-效果监测
    protected $gdt_fans_table = 'gdt_fans_table'; //广点通-企业微信加粉效果转发监测
    protected $gdt_follow_table = 'gdt_follow_table'; //广点通-企业微信加粉效果转发监测

    /**
     * 保存到数据库
     * @param $data 保存的数据
     * @param $table 保存表名字 
     * @return void
     */
    public function save_monitor($data, $table)
    {
        //only_id为空的话，直接返回失败
        if (empty($data['only_id'])) {
            return array('code' => '0', 'msg' => '失败');
        }

        //查询用户信息
        $res_day = $this->check_user_info($data);

        //如果用户为空的话直接失败
        if (empty($res_day)) {
            return array('code' => '0', 'msg' => '失败');
        }

        return $this->save_insert_fun($data, $table); //写入数据库
    }

    // 抖音写入数据库
    public function insert_dy($data)
    {
        switch ($data['bh']) { //根据不同的类型写不同的备注
            case '1':
                $data['bh_name'] = '有效触点';
                break;
            case '2':
                $data['bh_name'] = '视频播放';
                break;
            case '3':
                $data['bh_name'] = '视频播完';
                break;
            case '4':
                $data['bh_name'] = '视频有效播放';
                break;
        }

        $table = $this->dy_table;
        $res = $this->save_monitor($data, $table);
        return $res;
    }

    // 百度-大搜基木鱼写入数据库
    public function insert_baidu_check($data)
    {
        $table_name = $this->bd_check_table; //表名
        $res = $this->save_monitor($data, $table_name);
        return $res;
    }

    // 百度-信息流，写入数据库
    public function insert_baidu_info($data)
    {
        $table_name = $this->bd_info_table; //表名
        $res = $this->save_monitor($data, $table_name);
        return $res;
    }

    // 快手写入数据库
    public function insert_ks_crontral($data)
    {
        $table_name = $this->ks_table; //表名
        $res = $this->save_monitor($data, $table_name);
        return $res;
    }

    // 广点通-点击监测,写入数据库
    public function insert_gdt_click_crontral($data)
    {
        $table_name = $this->gdt_click_table; //表名
        $res = $this->save_monitor($data, $table_name);
        return $res;
    }

    // 广点通-曝光监测,写入数据库
    public function insert_gdt_exposure_crontral($data)
    {
        $table_name = $this->gdt_expo_table; //表名
        $res = $this->save_monitor($data, $table_name);
        return $res;
    }

    // 广点通-效果监测,写入数据库
    public function insert_gdt_effect_crontral($data)
    {
        $table_name = $this->gdt_effect_table; //表名
        $res = $this->save_monitor($data, $table_name);
        return $res;
    }

    // 广点通-企业微信加粉效果转发监测，,写入数据库
    public function insert_gdt_fans_crontral($data)
    {
        $table_name = $this->gdt_fans_table; //表名
        $res = $this->save_monitor($data, $table_name);
        return $res;
    }

    // 广点通-公众号关注效果转发监测，,写入数据库
    public function insert_gdt_follow_crontral($data)
    {
        $table_name = $this->gdt_follow_table; //表名
        $res = $this->save_monitor($data, $table_name);
        return $res;
    }

    //查询用户信息
    public function check_user_info($data)
    {
        //先把用户查出来
        $sql_day = "SELECT `id`,`uname`,`name`,`uid_sign` FROM `user` WHERE  `uid_sign`='" . $data['only_id'] . "'";
        $res_day = Db::query($sql_day);

        if (empty($res_day)) {
            return '';
        }

        return $res_day[0];
    }

    //写入数据库
    public function save_insert_fun($data, $table)
    {
        /*保存数据*/
        $res = Db::name($table)->insert($data);

        if (!$res) {
            return array('code' => '0', 'msg' => '保存数据失败');
        } else {
            return array('code' => '1', 'msg' => '成功');
        }
    }
}
