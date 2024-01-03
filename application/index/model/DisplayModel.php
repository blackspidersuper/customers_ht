<?php

namespace app\index\model;

use think\facade\Session;
use think\Model;
use think\Db;

class DisplayModel extends Model
{
    public $list_name_array = array(array('name' => '百度-大搜', 'table_name' => 'baidu_serach_check'), array('name' => '百度-信息流', 'table_name' => 'baidu_info'), array('name' => '抖音-有效触点', 'table_name' => 'dy_table', 'bh' => 1), array('name' => '抖音-视频播放', 'table_name' => 'dy_table', 'bh' => 2), array('name' => '抖音-视频播完', 'table_name' => 'dy_table', 'bh' => 3), array('name' => '抖音-视频有效播放', 'table_name' => 'dy_table', 'bh' => 4), array('name' => '快手', 'table_name' => 'ks_table')); //定义一个数组，用于去循环下面三个表

    /**
     * 数据展示
     * @param $uid *用户唯一标记

     * @return array
     */
    public function show_list_display($uid)
    {
        $pie_series = array(); //饼图的数据结构
        $other_series = array(); //其他图表的数据结构
        $data_arr = array(); //存放日期

        foreach ($this->list_name_array as $value) {

            $temporary_other_arr = array('name' => $value['name'], 'data' => array());
            $temporary_pie_arr = array();

            if ($value['table_name'] == 'dy_table') {
                 // 这种是其他图表的查询
                 $sql = "SELECT count(`id`) AS `num`,FROM_UNIXTIME(`add_time`,'%Y-%m-%d') AS `add_time` FROM `" . $value['table_name'] . "` ";
                 $where = "WHERE `bh`='".$value['bh']."' AND `only_id` = '" . $uid . "'  GROUP BY FROM_UNIXTIME(`add_time`,'%Y-%m-%d') ";
                 $all_res =  Db::query($sql . $where);
 
                 // 由于饼状图返回不一样
                 $pie_sql = "SELECT count(`id`) AS `num`, '" . $value['name'] . "' AS `name` FROM `" . $value['table_name'] . "`";
                 $pie_where = "WHERE `bh`='".$value['bh']."' AND  `only_id` = '" . $uid . "'";
                 $pie_res = Db::query($pie_sql . $pie_where);
            } else {
                // 这种是其他图表的查询
                $sql = "SELECT count(`id`) AS `num`,FROM_UNIXTIME(`add_time`,'%Y-%m-%d') AS `add_time` FROM `" . $value['table_name'] . "` ";
                $where = "WHERE `only_id` = '" . $uid . "'  GROUP BY FROM_UNIXTIME(`add_time`,'%Y-%m-%d') ";
                $all_res =  Db::query($sql . $where);

                // 由于饼状图返回不一样
                $pie_sql = "SELECT count(`id`) AS `num`, '" . $value['name'] . "' AS `name` FROM `" . $value['table_name'] . "`";
                $pie_where = "WHERE `only_id` = '" . $uid . "'";
                $pie_res = Db::query($pie_sql . $pie_where);
            }


            //整理饼图的结构
            $temporary_pie_arr[] = $pie_res[0]['name'];
            $temporary_pie_arr[] = (int)$pie_res[0]['num'];

            //整理其他图表结构
            foreach ($all_res as $value1) {
                array_push($temporary_other_arr['data'], (int)$value1['num']);
                array_push($data_arr, $value1['add_time']);
            }

            array_push($other_series, $temporary_other_arr);
            array_push($pie_series, $temporary_pie_arr);
        }


        //去重日期
        $uniqueData = array_unique($data_arr);
        // 按照日期排序  
        asort($uniqueData);

        //重构键值
        $last_date = array();
        foreach ($uniqueData as  $date_value) {
            array_push($last_date, $date_value);
        }

        return array('pie_chart' => $pie_series, 'other_chart' => $other_series, 'date' => $last_date);
    }

    /**
     * 下载
     * @param $uid *用户唯一标记
     * @param $key *下载类型
     * @param $type_pallet *下载平台
     * @return array
     */
    public function down_list($uid, $type_pallet, $key, $s_time, $e_time, $reply_num)
    {
        //强制转换时间信息为0点到23点
        $s_time = strtotime(date('Y-m-d', $s_time) . ' 00:00:00');
        $e_time = strtotime(date('Y-m-d', $e_time) . ' 23:59:59');


        //默认重复次数为10 
        if (empty($reply_num)) {
            if($reply_num==0){
                $reply_num=0;
            }else{
                $reply_num = 10;
            }
        }

        //查出用户的信息,防止跨级查询
        $sql = "SELECT `uid_sign` FROM `user` WHERE `id`='" . $uid . "'";
        $userinfo = Db::query($sql);

        if (empty($userinfo)) {
            return array('code' => 1, 'msg' => '下载用户异常');
        }

        $fun_name = 'down_' . $type_pallet . '_tel';
        $res = $this->$fun_name($userinfo[0]['uid_sign'], $key, $s_time, $e_time, $reply_num);
        return $res;
    }

    /**
     * 百度大搜下载
     * @param $uid *用户唯一标记
     * @param $key *下载类型
     * @param $type_pallet *下载平台
     * @param $s_time 开始时间
     * @param $e_time 结束时间
     * @param $reply_num 重复次数
     * @return array
     */
    public function down_bdds_tel($uid, $key, $s_time, $e_time, $reply_num)
    {
        $key_arr = array(
            'idfa' => 'idfa',
            'imei' => 'imei_md5',
            'oaid' => 'oaid'
        );

        $main_key = $key_arr[$key];

        $sql = "SELECT `" . $main_key . "` AS `" . $key . "` FROM `baidu_serach_check`  ";
        $where = "WHERE  `add_time` BETWEEN '" . $s_time . "' AND '" . $e_time . "' AND `only_id` = '" . $uid . "' AND `" . $main_key . "` <> '' GROUP BY `" . $main_key . "` HAVING COUNT(`id`) > " . $reply_num;
        $res = Db::query($sql . $where);

        if (empty($res)) {
            return array('code' => 1, 'msg' => '没有信息可供下载');
        }

        if (count($res) == 1) {
            if ($res[0][$key] == 'NULL') {
                return array('code' => 1, 'msg' => '没有信息可供下载1');
            }
        }

        return ['code' => 0, 'data' => $res,  'msg' => '下载成功'];
    }

    /**
     * 百度信息流下载
     * @param $uid *用户唯一标记
     * @param $key *下载类型
     * @param $type_pallet *下载平台
     * @param $s_time 开始时间
     * @param $e_time 结束时间
     * @param $reply_num 重复次数
     * @return array
     */
    public function down_bdinfo_tel($uid,  $key, $s_time, $e_time, $reply_num)
    {
        $key_arr = array(
            'idfa' => 'idfa',
            'imei' => 'imei_md5',
            'oaid' => 'oaid'
        );

        $main_key = $key_arr[$key];

        $sql = "SELECT `" . $main_key . "` AS `" . $key . "` FROM `baidu_info`  ";
        $where = "WHERE  `add_time` BETWEEN '" . $s_time . "' AND '" . $e_time . "' AND `only_id` = '" . $uid . "' AND `" . $main_key . "` <> '' GROUP BY `" . $main_key . "` HAVING COUNT(`id`) > " . $reply_num;
        $res = Db::query($sql . $where);

        if (empty($res)) {
            return array('code' => 1, 'msg' => '没有信息可供下载');
        }

        if (count($res) == 1) {
            if ($res[0][$key] == 'NULL') {
                return array('code' => 1, 'msg' => '没有信息可供下载1');
            }
        }

        return ['code' => 0, 'data' => $res,  'msg' => '下载成功'];
    }

    /**
     * 抖音下载
     * @param $uid *用户唯一标记
     * @param $key *下载类型
     * @param $type_pallet *下载平台
     * @param $s_time 开始时间
     * @param $e_time 结束时间
     * @param $reply_num 重复次数
     * @return array
     */
    public function down_douyin_tel($uid, $key, $s_time, $e_time, $reply_num)
    {
        $key_arr = array(
            'idfa' => 'idfa',
            'imei' => 'imei',
            'oaid' => 'oaid'
        );

        $main_key = $key_arr[$key];

        $sql = "SELECT `" . $main_key . "` AS `" . $key . "` FROM `dy_table`  ";
        $where = "WHERE  `add_time` BETWEEN '" . $s_time . "' AND '" . $e_time . "' AND `only_id` = '" . $uid . "' AND `" . $main_key . "` <> '' GROUP BY `" . $main_key . "` HAVING COUNT(`id`) > " . $reply_num;
        $res = Db::query($sql . $where);

        if (empty($res)) {
            return array('code' => 1, 'msg' => '没有信息可供下载');
        }

        if (count($res) == 1) {
            if ($res[0][$key] == 'NULL') {
                return array('code' => 1, 'msg' => '没有信息可供下载1');
            }
        }

        return ['code' => 0, 'data' => $res,  'msg' => '下载成功'];
    }

    /**
     * 快手下载
     * @param $uid *用户唯一标记
     * @param $key *下载类型
     * @param $type_pallet *下载平台
     *  @param $s_time 开始时间
     * @param $e_time 结束时间
     * @param $reply_num 重复次数
     * @return array
     */
    public function down_kuaishou_tel($uid,  $key, $s_time, $e_time, $reply_num)
    {

        $key_arr = array(
            'idfa' => 'idfa2',
            'imei' => 'imei3',
            'oaid' => 'oaidMD5'
        );

        $main_key = $key_arr[$key];

        $sql = "SELECT `" . $main_key . "` AS `" . $key . "` FROM `ks_table`  ";
        $where = "WHERE  `add_time` BETWEEN '" . $s_time . "' AND '" . $e_time . "' AND `only_id` = '" . $uid . "' AND `" . $main_key . "` <> '' GROUP BY `" . $main_key . "` HAVING COUNT(`id`) > " . $reply_num;
        $res = Db::query($sql . $where);

        if (empty($res)) {
            return array('code' => 1, 'msg' => '没有信息可供下载');
        }

        if (count($res) == 1) {
            if ($res[0][$key] == 'NULL') {
                return array('code' => 1, 'msg' => '没有信息可供下载1');
            }
        }

        return ['code' => 0, 'data' => $res,  'msg' => '下载成功'];
    }
}
