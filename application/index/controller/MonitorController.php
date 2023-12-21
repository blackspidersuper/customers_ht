<?php

namespace app\index\controller;

use think\Controller;
use think\facade\Request;
use app\index\model\MonitorModel;

class MonitorController extends Controller
{
    //获取dy监测链接信息，插入到数据库
    public function douyin_table()
    {
        $time = time();
        // 获取参数
        $postdata = [
            'bh' => Request::param('bh', ''), //触发行为，1有效触点，2视频播放，3视频播完，4视频有效播放
            'only_id' => Request::param('id', ''), //用户唯一标记
            'media_sign' => '抖音', //来源
            'user_name' => Request::param('user_name', ''), //用户名
            'imei' => Request::param('I', ''), //imei
            'os' => Request::param('OS', ''), //os
            'model' => Request::param('MODEL', ''), //model
            'caid' => Request::param('caid', ''), //caid
            'aid' => Request::param('AID', ''), //aid
            'campaign_name' => Request::param('CAMPAIGN_NAME', ''), //campaign_name
            'promotionid' => Request::param('promotionid', ''), //广告计划ID
            'aid_name' => Request::param('AID_NAME', ''), //aid_name
            'cid_name' => Request::param('CID_NAME', ''), //cid_name
            'idfa' => Request::param('idfa', ''), //idfa
            'android_id' => Request::param('androidid', ''), //android_id
            'oaid' => Request::param('oaid', ''), //oaid
            'oaid_md5' => Request::param('oaid_md5', ''), //oaid_md5
            'ts' => Request::param('ts', ''), //ts
            'callback' => Request::param('callback', ''), //callback
            'csite' => Request::param('csite', ''), //csite
            'remark' => Request::param('name', ''), //备注
            'add_time' => $time, //添加时间
            'ip' => Request::param('IP', '') //ip
        ];

        //检查参数缺失,如果缺失就提前结束请求
        if (empty($postdata['bh'])) {
            return json(['code' => '0', 'msg' => '缺少参数1']);
        }

        if (!in_array($postdata['bh'], array(1, 2, 3, 4))) { //如果不在1,2,3,4,那么就直接返回false
            return json(['code' => '0', 'msg' => '参数错误']);
        }

        $mod = new MonitorModel();
        $res = $mod->insert_dy($postdata);

        return json($res);
    }

    /**
     * 百度-大搜基木鱼，获取监测链接信息，插入到数据库
     *
     * @return void
     */
    public function baidu_table_check()
    {
        $time = time();

        // 获取参数
        $postdata = [
            'only_id' => Request::param('id', ''), //用户唯一标记
            'media_sign' => '百度-大搜基木鱼', //来源
            'user_name' => Request::param('user_name', ''), //用户名
            'user_id' => Request::param('userid', ''), //userid
            'caid' => Request::param('caid', ''), //caid
            'aid' => Request::param('aid', ''), //aid
            'pid' => Request::param('pid', ''), //pid
            'uid' => Request::param('uid', ''), //uid
            'word_id' => Request::param('wordid', ''), //wordid
            'product_id' => Request::param('productid', ''), //productid
            'click_id' => Request::param('click_id', ''), //CLICK_ID
            'idfa' => Request::param('idfa', ''), //idfa
            'imei_md5' => Request::param('imei_md5', ''), //imei_md5
            'oaid' => Request::param('oaid', ''), //oaid
            'oaid_md5' => Request::param('oaid_md5', ''), //oaid_md5
            'android_id_md5' => Request::param('android_id_md5', ''), //android_id_md5
            'os' => Request::param('os', ''), //os
            'interactionsType' => Request::param('interactionsType', ''), //interactionsType
            'remark' => Request::param('name', ''), //备注
            'add_time' => $time, //添加时间
            'ip' => Request::param('ip', ''), //ip
            'ext_info' => Request::param('ext_info', ''), //ext_info
            'callType' => 'v2'
        ];

        $mod = new MonitorModel();
        $res = $mod->insert_baidu_check($postdata);

        return json($res);
    }

    /**
     * 百度-信息流，获取监测链接信息，插入到数据库
     *
     * @return void
     */
    public function baidu_table_info()
    {
        $time = time();

        // 获取参数
        $postdata = [
            'only_id' => Request::param('id', ''), //用户唯一标记
            'media_sign' => '百度-信息流', //来源
            'user_name' => Request::param('user_name', ''), //用户名
            'idfa' => Request::param('idfa', ''), //idfa
            'imei_md5' => Request::param('I', ''), //imei_md5
            'os' => Request::param('OS', ''), //os
            'ts' => Request::param('ts', ''), //ts
            'caid' => Request::param('caid', ''), //caid
            'aid' => Request::param('aid', ''), //aid
            'oaid' => Request::param('oaid', ''), //oaid
            'android_id' => Request::param('ANDROID_ID', ''), //android_id
            'uid' => Request::param('uid', ''), //uid
            'word_id' => Request::param('wordid', ''), //wordid
            'product_id' => Request::param('productid', ''), //productid
            'click_id' => Request::param('click_id', ''), //click_id
            'interactionsType' => Request::param('interactionsType', ''), //interactionsType
            'remark' => Request::param('name', ''), //备注
            'add_time' => $time, //添加时间
            'ip' => Request::param('ip', ''), //ip
            'ext_info' => Request::param('ext_info', ''), //ext_info
            'callType' => 'v2'
        ];

        $mod = new MonitorModel();
        $res = $mod->insert_baidu_info($postdata);

        return json($res);
    }

    /**
     * 快手，获取监测链接信息，插入到数据库
     *
     * @return void
     */
    public function kuaishou_table_all()
    {
        $time = time();

        // 获取参数
        $postdata = [
            'only_id' => Request::param('id', ''), //用户唯一标记
            'media_sign' => '快手', //来源
            'username' => Request::param('username', ''), //用户名
            'accountid' => Request::param('accountid', ''), //广告账户ID
            'did' => Request::param('did', ''), //广告计划ID
            'aid' => Request::param('aid', ''), //广告组ID
            'cid' => Request::param('cid', ''), //广告创意ID
            'dname' => Request::param('dname', ''), //广告计划名称
            'unitname' => Request::param('unitname', ''), //广告组名称
            'photoid' => Request::param('photoid', ''), //素材ID加密值
            'oaidMD5' => Request::param('oaidMD5', ''), //Android设备标识计算MD5
            'imeiMD5' => Request::param('imeiMD5', ''), //对15位数字的 IMEI
            'imei3' => Request::param('imei3', ''), //Android下的IMEI
            'imei4' => Request::param('imei4', ''), //IMEI进行 MD5
            'idfa2' => Request::param('idfa2', ''), // iOS下的idfa计算MD5,
            'idfa3' => Request::param('idfa3', ''), //   iOS下的idfa计算SHA1,
            'kenyid_caa' => Request::param('kenyid_caa', ''), //   URL Encode后的JSON数组,
            'mac2' => Request::param('mac2', ''), //   对 MAC 进行 MD5,
            'mac3' => Request::param('mac3', ''), //   对 MAC 去除分隔符之后进行 MD5,
            'androidid2' => Request::param('androidid2', ''), //   对 ANDROIDID进行 MD5,
            'androidid3' => Request::param('androidid3', ''), //   Android下的AndroidID,
            'ts' => Request::param('ts', ''), //   UTC时间戳,
            'ua' => Request::param('ua', ''), //   客户端UA,
            'os' => Request::param('os', ''), //   OS系统,
            'model' => Request::param('model', ''), //   手机型号,
            'callback' => Request::param('callback', ''), //   回调信息，编码一次的URL,
            'ip' => Request::param('ip', ''), //   使用对端请求的ip地址,
            'ipv4' => Request::param('ipv4', ''), //   优先使用上报请求的对端 IPV4 地址,
            'ipv6' => Request::param('ipv6', ''), //   优先使用上报请求的对端 IPV6地址,
            'csite' => Request::param('csite', ''), //   广告投放场景,
            'ac_creative' => Request::param('ac_creative', ''), //   是否为高级创意,
            'winfoid' => Request::param('winfoid', ''), //   仅支持搜索流量，winfoid可通过marketing api 中关键词接口获得，对应word_info_id，如果为非搜索流量或智能扩词流量，则winfoid不替换
            'llsid' => Request::param('llsid', ''), //   快手请求id,
            'remark' => Request::param('name', ''), //   备注,
            'add_time' => $time, //添加时间
        ];

        $mod = new MonitorModel();
        $res = $mod->insert_ks_crontral($postdata);

        return json($res);
    }


    /**
     * 广点通，点击监测，插入到数据库
     *
     * @return void
     */
    public function gdt_click_table_all()
    {
        $time = time();

        // 获取参数
        $postdata = [
            'only_id' => Request::param('id', ''), //用户唯一标记
            'media_sign' => '广点通-点击', //来源
            'user_name' => Request::param('username', ''), //用户名
            'click_id' => Request::param('click_id', ''),
            'click_time' => Request::param('click_time', ''),
            'impression_time' => Request::param('impression_time', ''),
            'campaign_id' => Request::param('campaign_id', ''),
            'adgroup_id' => Request::param('adgroup_id', ''),
            'ad_id' => Request::param('ad_id', ''),
            'ad_platform_type' => Request::param('ad_platform_type', ''),
            'ad_type' => Request::param('ad_type', ''),
            'account_id' => Request::param('account_id', ''),
            'agency_id' => Request::param('agency_id', ''),
            'click_sku_id' => Request::param('click_sku_id', ''),
            'billing_event' => Request::param('billing_event', ''),
            'deeplink_url' => Request::param('deeplink_url', ''),
            'universal_link' => Request::param('universal_link', ''),
            'page_url' => Request::param('page_url', ''),
            'device_os_type' => Request::param('device_os_type', ''),
            'process_time' => Request::param('process_time', ''),
            'promoted_object_id' => Request::param('promoted_object_id', ''),
            'promoted_object_type' => Request::param('promoted_object_type', ''),
            'request_id' => Request::param('request_id', ''),
            'impression_id' => Request::param('impression_id', ''),
            'site_set' => Request::param('site_set', ''),
            'muid' => Request::param('muid', ''),
            'hash_android_id' => Request::param('hash_android_id', ''),
            'ip' => Request::param('ip', ''),
            'user_agent' => Request::param('user_agent', ''),
            'callback' => Request::param('callback', ''),
            'encrypted_position_id' => Request::param('encrypted_position_id', ''),
            'ipv6' => Request::param('ipv6', ''),
            'hash_oaid' => Request::param('hash_oaid', ''),
            'qaid_caa' => Request::param('qaid_caa', ''),
            'adgroup_name' => Request::param('adgroup_name', ''),
            'site_set_name' => Request::param('site_set_name', ''),
            'campaign_name' => Request::param('campaign_name', ''),
            'ad_name' => Request::param('ad_name', ''),
            'model' => Request::param('model', ''),
            'boost_exp_info' => Request::param('boost_exp_info', ''),
            'boost_model_id' => Request::param('boost_model_id', ''),
            'wechat_openid' => Request::param('wechat_openid', ''),
            'keyword_id' => Request::param('keyword_id', ''),
            'keyword_text' => Request::param('keyword_text', ''),
            'ip_md5' => Request::param('ip_md5', ''),
            'ipv6_md5' => Request::param('ipv6_md5', ''),
            'caid' => Request::param('caid', ''),
            'remark' => Request::param('name', ''), //   备注,
            'add_time' => $time, //添加时间
        ];


        $mod = new MonitorModel();
        $res = $mod->insert_gdt_click_crontral($postdata);
        return json($res);
    }

    /**
     * 广点通，曝光监测，插入到数据库
     *
     * @return void
     */
    public function gdt_exposure_table_all()
    {
        $time = time();

        // 获取参数
        $postdata = [
            'only_id' => Request::param('id', ''), //用户唯一标记
            'media_sign' => '广点通-曝光监测', //来源
            'user_name' => Request::param('username', ''), //用户名
            'impression_id' => Request::param('impression_id', ''),
            'impression_time' => Request::param('impression_time', ''),
            'campaign_id' => Request::param('campaign_id', ''),
            'adgroup_id' => Request::param('adgroup_id', ''),
            'ad_id' => Request::param('ad_id', ''),
            'ad_platform_type' => Request::param('ad_platform_type', ''),
            'ad_type' => Request::param('ad_type', ''),
            'account_id' => Request::param('account_id', ''),
            'agency_id' => Request::param('agency_id', ''),
            'impression_sku_id' => Request::param('impression_sku_id', ''),
            'billing_event' => Request::param('billing_event', ''),
            'deeplink_url' => Request::param('deeplink_url', ''),
            'universal_link' => Request::param('universal_link', ''),
            'page_url' => Request::param('page_url', ''),
            'device_os_type' => Request::param('device_os_type', ''),
            'process_time' => Request::param('process_time', ''),
            'promoted_object_id' => Request::param('promoted_object_id', ''),
            'promoted_object_type' => Request::param('promoted_object_type', ''),
            'request_id' => Request::param('request_id', ''),
            'site_set' => Request::param('site_set', ''),
            'muid' => Request::param('muid', ''),
            'hash_android_id' => Request::param('hash_android_id', ''),
            'ip' => Request::param('ip', ''),
            'user_agent' => Request::param('user_agent', ''),
            'callback' => Request::param('callback', ''),
            'encrypted_position_id' => Request::param('encrypted_position_id', ''),
            'ipv6' => Request::param('ipv6', ''),
            'hash_oaid' => Request::param('hash_oaid', ''),
            'qaid_caa' => Request::param('qaid_caa', ''),
            'adgroup_name' => Request::param('adgroup_name', ''),
            'site_set_name' => Request::param('site_set_name', ''),
            'ad_name' => Request::param('ad_name', ''),
            'model' => Request::param('model', ''),
            'boost_exp_info' => Request::param('boost_exp_info', ''),
            'boost_model_id' => Request::param('boost_model_id', ''),
            'wechat_openid' => Request::param('wechat_openid', ''),
            'keyword_id' => Request::param('keyword_id', ''),
            'keyword_text' => Request::param('keyword_text', ''),
            'ip_md5' => Request::param('ip_md5', ''),
            'ipv6_md5' => Request::param('ipv6_md5', ''),
            'caid' => Request::param('caid', ''),
            'remark' => Request::param('name', ''), //   备注,
            'add_time' => $time, //添加时间
        ];



        $mod = new MonitorModel();
        $res = $mod->insert_gdt_exposure_crontral($postdata);
        return json($res);
    }

    /**
     * 广点通，效果监测，插入到数据库
     *
     * @return void
     */
    public function gdt_effect_table_all()
    {
        $time = time();

        // 获取参数
        $postdata = [
            'only_id' => Request::param('id', ''), //用户唯一标记
            'media_sign' => '广点通-效果监测', //来源
            'user_name' => Request::param('username', ''), //用户名
            'wechat_openid' => Request::param('wechat_openid', ''),
            'adgroup_id' => Request::param('adgroup_id', ''),
            'campaign_id' => Request::param('campaign_id', ''),
            'wechat_account_id' => Request::param('wechat_account_id', ''),
            'act_time' => Request::param('act_time', ''),
            'position_id' => Request::param('position_id', ''),
            'trace_id' => Request::param('trace_id', ''),
            'wechat_unionid' => Request::param('wechat_unionid', ''),
            'ad_id' => Request::param('ad_id', ''),
            'canvas_id' => Request::param('canvas_id', ''),
            'wechat_agency_id' => Request::param('wechat_agency_id', ''),
            'qywx_corp_id' => Request::param('qywx_corp_id', ''),
            'add_channel' => Request::param('add_channel', ''),
            'muid' => Request::param('muid', ''),
            'click_time' => Request::param('click_time', ''),
            'click_id' => Request::param('click_id', ''),
            'app_type' => Request::param('app_type', ''),
            'appid' => Request::param('appid', ''),
            'advertiser_id' => Request::param('advertiser_id', ''),
            'remark' => Request::param('name', ''), //   备注,
            'add_time' => $time, //添加时间
        ];

        $mod = new MonitorModel();
        $res = $mod->insert_gdt_effect_crontral($postdata);
        return json($res);
    }

    /**
     * 广点通，企业微信加粉效果转发监测，插入到数据库
     *
     * @return void
     */
    public function gdt_fans_table_all()
    {
        $time = time();

        // 获取参数
        $postdata = [
            'only_id' => Request::param('id', ''), //用户唯一标记
            'media_sign' => '广点通-企业微信加粉效果转发监测', //来源
            'user_name' => Request::param('username', ''), //用户名
            'trace_id' => Request::param('trace_id', ''),
            'wechat_unionid' => Request::param('wechat_unionid', ''),
            'adgroup_id' => Request::param('adgroup_id', ''),
            'click_time' => Request::param('click_time', ''),
            'qywx_corp_id' => Request::param('qywx_corp_id', ''),
            'add_channel' => Request::param('add_channel', ''),
            'campaign_id' => Request::param('campaign_id', ''),
            'ad_id' => Request::param('ad_id', ''),
            'addway' => Request::param('addway', ''),
            'advertiser_id' => Request::param('advertiser_id', ''),
            'canvas_id' => Request::param('canvas_id', ''),
            'remark' => Request::param('name', ''), //   备注,
            'add_time' => $time, //添加时间
        ];

        $mod = new MonitorModel();
        $res = $mod->insert_gdt_fans_crontral($postdata);
        return json($res);
    }

    /**
     * 广点通，公众号关注效果转发监测，插入到数据库
     *
     * @return void
     */
    public function gdt_follow_table_all()
    {
        $time = time();

        // 获取参数
        $postdata = [
            'only_id' => Request::param('id', ''), //用户唯一标记
            'media_sign' => '广点通-公众号关注效果转发', //来源
            'user_name' => Request::param('username', ''), //用户名
            'trace_id' => Request::param('trace_id', ''),
            'wechat_openid' => Request::param('wechat_openid', ''),
            'adgroup_id' => Request::param('adgroup_id', ''),
            'act_time' => Request::param('act_time', ''),
            'campaign_id' => Request::param('campaign_id', ''),
            'ad_id' => Request::param('ad_id', ''),
            'wechat_account_id' => Request::param('wechat_account_id', ''),
            'position_id' => Request::param('position_id', ''),
            'advertiser_id' => Request::param('advertiser_id', ''),
            'device_os_type' => Request::param('device_os_type', ''),
            'remark' => Request::param('name', ''), //   备注,
            'add_time' => $time, //添加时间
        ];

        $mod = new MonitorModel();
        $res = $mod->insert_gdt_follow_crontral($postdata);
        return json($res);
    }
}
