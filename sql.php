<?php

$param = $_SERVER['argv'];

// 连接数据库  
$servername = $_SERVER['argv'][1];  // 数据库服务器名称  
$username = $_SERVER['argv'][2];    // 数据库用户名  
$password = $_SERVER['argv'][3];    // 数据库密码  
$dbname = $_SERVER['argv'][4];      // 数据库名称

$account_uname =  $_SERVER['argv'][5]; //账号
$account_pwd =  $_SERVER['argv'][6]; //密码
$account_name =  $_SERVER['argv'][7]; //用户名

$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接是否成功  
if ($conn->connect_error) {

  if (strpos($conn->connect_error, 'Unknown database') !== false) {
    die($_SERVER['argv'][4] . " 数据库不存在，请新建数据库\n");
  }

  die("连接失败: " . $conn->connect_error);
}

// 检查是否存在数据库  
$checkDb = "SHOW DATABASES LIKE '" . $_SERVER['argv'][4] . "';";
$resultDb = $conn->query($checkDb);

$user_bind_sql = "CREATE TABLE `user` (
    `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
    `uname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户名',
    `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名称',
    `uid_sign` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '唯一标识',
    `passwd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '密码',
    `created` int(11) NOT NULL COMMENT '创建时间',
    PRIMARY KEY (`id`) USING BTREE,
    UNIQUE KEY `uname` (`uname`) USING BTREE
  ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户表'; ";

$baidu_info_bind_sql = "CREATE TABLE `baidu_info` (
    `id` int NOT NULL AUTO_INCREMENT COMMENT '主键',
    `only_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户随机id（md5）',
    `media_sign` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '来源',
    `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户名字',
    `idfa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'idfa',
    `imei_md5` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'imei_md5',
    `os` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'os',
    `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ip',
    `ts` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ts',
    `caid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '中国广告协会互联网广告标识',
    `aid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'aid',
    `oaid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'oaid',
    `android_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'android_id',
    `interactionsType` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '触发行为',
    `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '备注',
    `add_time` int DEFAULT NULL COMMENT '添加时间',
    `uid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '单元ID',
    `word_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '关键词ID',
    `product_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '商品ID',
    `click_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '点击唯一标识',
    `ext_info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ext_info',
    `callType` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'callType',
    PRIMARY KEY (`id`) USING BTREE
  ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='百度-信息流'; ";


$baidu_serach_bind_sql = "CREATE TABLE `baidu_serach_check` (
    `id` int NOT NULL AUTO_INCREMENT COMMENT '主键',
    `only_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户随机id（md5）',
    `media_sign` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '来源',
    `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户名字',
    `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'userid',
    `aid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'aid',
    `pid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'pid',
    `uid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'uid',
    `word_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'wordid',
    `click_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '点击唯一ID',
    `product_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'productid',
    `idfa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'idfa',
    `imei_md5` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'imei_md5',
    `oaid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'oaid',
    `oaid_md5` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'oaid_md5',
    `android_id_md5` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'android_id_md5',
    `os` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'os',
    `interactionsType` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '触发行为',
    `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ip',
    `caid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '中国广告协会互联网广告标识',
    `callType` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'callType',
    `ext_info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ext_info',
    `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '备注',
    `add_time` int DEFAULT NULL COMMENT '添加时间',
    PRIMARY KEY (`id`) USING BTREE
  ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='百度-大搜基木鱼';";


$dy_bind_sql = "CREATE TABLE `dy_table` (
    `id` int NOT NULL AUTO_INCREMENT COMMENT '主键',
    `only_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户id(md5)',
    `media_sign` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '来源',
    `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户名字',
    `bh_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '触发行为名字',
    `bh` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '触发行为，1是有效触点，2是视频播放，3是视频播完，4是视频有效播放',
    `imei` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'imei',
    `os` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'os',
    `model` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'model',
    `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ip',
    `caid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '中国广告协会互联网广告标识',
    `aid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'aid',
    `campaign_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'campaign_name',
    `aid_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'aid_name',
    `cid_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'cid_name',
    `idfa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'idfa',
    `android_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'android_id',
    `oaid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'oaid',
    `oaid_md5` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'oaid_md5',
    `ts` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ts',
    `callback` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'callback',
    `csite` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'csite',
    `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '备注',
    `add_time` int DEFAULT NULL COMMENT '添加时间',
    `promotionid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '广告计划ID',
    PRIMARY KEY (`id`) USING BTREE
  ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='抖音-有效触点';";

$gdt_click_bind_sql = "CREATE TABLE `gdt_click_table` (
    `id` int NOT NULL AUTO_INCREMENT COMMENT '主键',
    `only_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户id(md5)',
    `media_sign` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '来源',
    `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户名字',
    `click_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '点击id',
    `click_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '点击时间',
    `impression_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '曝光时间',
    `campaign_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '计划id',
    `adgroup_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '广告组id（实际为广告id）',
    `ad_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '广告id（实际为创意id）',
    `ad_platform_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '广告投放平台',
    `ad_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '广告类型',
    `account_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '广告主id',
    `agency_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '代理商id',
    `click_sku_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '点击sku',
    `billing_event` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '计费类型',
    `deeplink_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '应用直达链接（Android）',
    `universal_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '应用直达链接（iOS）',
    `page_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '落地页地址',
    `device_os_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '设备类型',
    `process_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '请求时间',
    `promoted_object_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '应用id',
    `promoted_object_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '推广类型',
    `request_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '请求id',
    `impression_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '曝光id',
    `site_set` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '站点集（待废弃，建议使用site_set_name）',
    `muid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '设备id（imei或idfa的加密值）',
    `hash_android_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '安卓id做md5加密后小写',
    `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '媒体投放系统获取的用户终端的公共IPV4地址',
    `user_agent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户代理（user_agent）',
    `callback` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '直接提供上报信息回传接口的 url，示例为url encode编码原值，广告主需要decode作为post请求url回传至AMS',
    `encrypted_position_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '联盟广告位id',
    `ipv6` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '媒体投放系统获取的用户终端的公共IPV6地址',
    `hash_oaid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Android Q 及更高版本的设备号，64位及以下，取原值后做md5加密',
    `qaid_caa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'URL Encode后的JSON数组；其中qaid为中广协ID（即CAID），hash_qaid为CAID原值MD5加密后的结果, version为腾讯版本号',
    `adgroup_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '广告组名称',
    `site_set_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '广告版位',
    `campaign_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '计划名称',
    `ad_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '广告名称',
    `model` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '机型',
    `boost_exp_info` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '专用于ROI策略(原联合专区RuleLab)的UV分组实验信息，用于区分实验组和对照组',
    `boost_model_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '专用于ROI策略(原联合专区RuleLab)，对应ROI策略的策略ID(原Rule ID)，用于定位对应的ROI策略',
    `wechat_openid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '专用于网页类小程序转化规则的点击监测下发，其它类型不支持该字段下发。每个用户针对小程序应用会产生一个安全的OpenID,只针对当前的小程序有效',
    `keyword_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '专用于搜索广告的关键词ID下发，仅在搜索广告计划的QQ浏览器和应用宝版位下发',
    `keyword_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '专用于搜索广告的关键词下发，仅在搜索广告计划的QQ浏览器和应用宝版位下发',
    `ip_md5` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '媒体投放系统获取的用户终端的公共IPV4地址MD5加密后转小写，仅在新版转化里支持配置',
    `ipv6_md5` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '媒体投放系统获取的用户终端的公共IPV6地址MD5加密后转小写，仅在新版转化里支持配置',
    `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '备注',
    `caid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'URL Encode后的JSON数组:其中caid为中广协ID（即CAID），hash_caid为CAID原值MD5加密后的结果, version为中广协caid版本号',
    `add_time` int DEFAULT NULL COMMENT '添加时间',
    PRIMARY KEY (`id`) USING BTREE
  ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='广点通-点击监测';";

$gdt_effect_bind_sql = "CREATE TABLE `gdt_effect_table` (
    `id` int NOT NULL AUTO_INCREMENT COMMENT '主键',
    `only_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户id(md5)',
    `media_sign` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '来源',
    `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户名字',
    `wechat_openid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'wechat_openid',
    `adgroup_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'adgroup_id',
    `campaign_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'campaign_id',
    `wechat_account_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'wechat_account_id',
    `act_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'act_time',
    `position_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'position_id',
    `trace_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'trace_id',
    `wechat_unionid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'wechat_unionid',
    `ad_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ad_id',
    `canvas_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'canvas_id',
    `wechat_agency_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'wechat_agency_id',
    `qywx_corp_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'qywx_corp_id',
    `add_channel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'add_channel',
    `muid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'muid',
    `click_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'click_time',
    `click_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'click_id',
    `app_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'app_type',
    `appid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'appid',
    `advertiser_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'advertiser_id',
    `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '备注',
    `add_time` int DEFAULT NULL COMMENT '添加时间',
    PRIMARY KEY (`id`) USING BTREE
  ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='广点通-效果监测';";


$gdt_expo_bind_sql = "CREATE TABLE `gdt_expo_table` (
    `id` int NOT NULL AUTO_INCREMENT COMMENT '主键',
    `only_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户id(md5)',
    `media_sign` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '来源',
    `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户名字',
    `impression_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '曝光id',
    `impression_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '曝光时间',
    `campaign_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '计划id',
    `adgroup_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '广告组id',
    `ad_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '广告id',
    `ad_platform_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '广告投放平台',
    `ad_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '广告类型',
    `account_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '广告主id',
    `agency_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '代理商id',
    `impression_sku_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '曝光sku',
    `billing_event` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '计费类型',
    `deeplink_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '应用直达链接（Android）',
    `universal_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '应用直达链接（iOS）',
    `page_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '落地页地址',
    `device_os_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '设备类型',
    `process_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '请求时间',
    `promoted_object_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '应用id',
    `promoted_object_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '推广类型',
    `request_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '请求id',
    `site_set` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '站点集（待废弃，建议使用site_set_name）',
    `muid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '设备id（imei或idfa的加密值）',
    `hash_android_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '安卓id做md5加密后小写',
    `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '媒体投放系统获取的用户终端的公共IPV4地址',
    `user_agent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户代理（user_agent）',
    `callback` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '直接提供上报信息回传接口的 url，示例为url encode编码原值，广告主需要decode作为post请求url回传至AMS',
    `encrypted_position_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '联盟广告位id',
    `ipv6` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '媒体投放系统获取的用户终端的公共IPV6地址',
    `hash_oaid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Android Q 及更高版本的设备号，64位及以下，取原值后做md5加密',
    `qaid_caa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'URL Encode后的JSON数组；其中qaid为中广协ID（即CAID），hash_qaid为CAID原值MD5加密后的结果, version为腾讯版本号',
    `adgroup_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '广告名称',
    `site_set_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '广告版位',
    `ad_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '创意名称',
    `model` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '机型',
    `boost_exp_info` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '专用于ROI策略(原联合专区RuleLab)的UV分组实验信息，用于区分实验组和对照组',
    `boost_model_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '专用于ROI策略(原联合专区RuleLab)，对应ROI策略的策略ID(原Rule ID)，用于定位对应的ROI策略',
    `wechat_openid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '专用于网页类小程序转化规则的点击监测下发，其它类型不支持该字段下发。每个用户针对小程序应用会产生一个安全的OpenID,只针对当前的小程序有效',
    `keyword_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '专用于搜索广告的关键词ID下发，仅在搜索广告计划的QQ浏览器和应用宝版位下发',
    `keyword_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '专用于搜索广告的关键词下发，仅在搜索广告计划的QQ浏览器和应用宝版位下发',
    `ip_md5` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '媒体投放系统获取的用户终端的公共IPV4地址MD5加密后转小写，仅在新版转化里支持配置',
    `ipv6_md5` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '媒体投放系统获取的用户终端的公共IPV6地址MD5加密后转小写，仅在新版转化里支持配置',
    `caid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'URL Encode后的JSON数组:其中caid为中广协ID（即CAID），hash_caid为CAID原值MD5加密后的结果, version为中广协caid版本号',
    `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '备注',
    `add_time` int DEFAULT NULL COMMENT '添加时间',
    PRIMARY KEY (`id`) USING BTREE
  ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='广点通-曝光监测';";


$gdt_fans_bind_sql = "CREATE TABLE `gdt_fans_table` (
    `id` int NOT NULL AUTO_INCREMENT COMMENT '主键',
    `only_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户id(md5)',
    `media_sign` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '来源',
    `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户名字',
    `trace_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'traceid',
    `wechat_unionid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'wechat_unionid',
    `adgroup_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '广告id',
    `click_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '点击时间',
    `qywx_corp_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '企业微信主体id',
    `add_channel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '归因类型',
    `campaign_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '推广计划ID',
    `ad_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '创意ID',
    `addway` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '添加渠道',
    `advertiser_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '广告主ID',
    `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '备注',
    `canvas_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '微信广告原生页ID',
    `add_time` int DEFAULT NULL COMMENT '添加时间',
    PRIMARY KEY (`id`) USING BTREE
  ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='广点通-企业微信加粉效果转发监测';";

$gdt_follow_bind_sql = "CREATE TABLE `gdt_follow_table` (
    `id` int NOT NULL AUTO_INCREMENT COMMENT '主键',
    `only_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户id(md5)',
    `media_sign` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '来源',
    `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户名字',
    `trace_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'traceid',
    `wechat_openid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'wechat_openid',
    `adgroup_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '广告id',
    `act_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '关注发生时间',
    `campaign_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '推广计划ID',
    `ad_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '创意ID',
    `wechat_account_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '微信广告appid',
    `position_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '广告位ID',
    `advertiser_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '广告主id',
    `device_os_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '请求设备的操作系统类型',
    `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '备注',
    `add_time` int DEFAULT NULL COMMENT '添加时间',
    PRIMARY KEY (`id`) USING BTREE
  ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='广点通-公众号关注效果转发监测';";

$ks_bind_sql = "CREATE TABLE `ks_table` (
    `id` int NOT NULL AUTO_INCREMENT COMMENT '主键',
    `only_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户id(md5)',
    `media_sign` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '来源',
    `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户名字',
    `accountid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '广告账户ID',
    `did` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '广告计划ID',
    `aid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '广告组ID',
    `cid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '广告创意ID',
    `dname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '广告计划名称',
    `unitname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '广告组名称',
    `photoid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '素材ID加密值',
    `oaidMD5` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Android设备标识计算MD5',
    `imeiMD5` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '对15位数字的 IMEI （比如860576038225452）进行 MD5',
    `imei3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Android下的IMEI',
    `imei4` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'IMEI进行 MD5',
    `idfa2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'iOS下的idfa计算MD5',
    `idfa3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'iOS下的idfa计算SHA1',
    `kenyid_caa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'URL Encode后的JSON数组',
    `mac2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '对 MAC 进行 MD5',
    `mac3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '对 MAC 去除分隔符之后进行 MD5',
    `androidid2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '对 ANDROIDID进行 MD5',
    `androidid3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Android下的AndroidID',
    `ts` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'UTC时间戳',
    `ua` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '客户端UA',
    `os` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'OS系统',
    `model` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '手机型号',
    `callback` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '回调信息，编码一次的URL',
    `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '使用对端请求的ip地址',
    `ipv4` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '优先使用上报请求的对端 IPV4 地址',
    `ipv6` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '优先使用上报请求的对端 IPV6地址',
    `csite` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '广告投放场景',
    `ac_creative` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '是否为高级创意',
    `winfoid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '仅支持搜索流量，winfoid可通过marketing api 中关键词接口获得，对应word_info_id，如果为非搜索流量或智能扩词流量，则winfoid不替换',
    `llsid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '快手请求id',
    `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '备注',
    `add_time` int DEFAULT NULL,
    PRIMARY KEY (`id`) USING BTREE
  ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='快手';";




if ($resultDb->num_rows > 0) {

  $time = time();

  $arr = array(
    'user' => $user_bind_sql,
    'baidu_info' => $baidu_info_bind_sql,
    'baidu_serach_check' => $baidu_serach_bind_sql,
    'dy_table' => $dy_bind_sql,
    'gdt_click_table' => $gdt_click_bind_sql,
    'gdt_effect_table' => $gdt_effect_bind_sql,
    'gdt_expo_table' => $gdt_expo_bind_sql,
    'gdt_fans_table' => $gdt_fans_bind_sql,
    'gdt_follow_table' => $gdt_follow_bind_sql,
    'ks_table' => $ks_bind_sql
  );

  $check_true = 0;

  foreach ($arr as $key => $value) {
    $check_code = add_table($key, $conn, $value, $account_uname, $account_pwd, $password, $account_name, $time,$dbname);

    if ($check_code == 1) {
      $check_true = 1;
    }
  }

  if ($check_true == 1) {
    echo "\n";
    echo "创建表异常\n";
  } else {

    echo "\n";
    echo "你的账号：" . $account_uname . "\n";
    echo "你的密码：" . $account_pwd . "\n";
    echo "你的用户名：" . $account_name . "\n";
    echo "请保管好！\n";

    $currentDir = dirname(__FILE__);

    // 删除当前目录的文件  
    $logFilePath = $currentDir . '/sql.php';
    if (file_exists($logFilePath)) {
       unlink($logFilePath);
    }
  }
} else {
  // 不存在数据库  
  echo $_SERVER['argv'][4] . " 数据库不存在\n";
}

function add_table($table_name, $conn, $sql, $account_uname, $account_pwd, $password, $account_name, $time,$dbname)
{
  // 检查是否存在表  
  $checkTable = "SHOW TABLES LIKE '" . $table_name . "';";
  $result = $conn->query($checkTable);

  if ($result->num_rows > 0) {
    echo $table_name . " 表存在\n";
     return 1;
  } else {
    // 执行语句
    if ($conn->query($sql) === TRUE) {

      echo "创建" . $table_name . " 表成功\n";

      if ($table_name == 'user') {

        $uid_sign = md5($account_uname . $time);
        $psd_md = md5('m4jWe2dazUAtV2GIeN1pDaWMSJlJbbBD' . $time . $account_pwd . $password);
        $inser_sql = "INSERT INTO `".$dbname."`.`user` (`uname`, `name`, `uid_sign`, `passwd`, `created`) VALUES ('" . $account_uname . "', '" . $account_name . "', '" . $uid_sign . "', '" . $psd_md . "',  " . $time . ")";

        if ($conn->query($inser_sql) === TRUE) {
          echo "建立用户" . $account_uname . " 成功！！\n";
          return 0;
        } else {
          echo "建立用户" . $account_uname . " 失败！！\n";
  
          return 1;
        }
      }
    } else {
      echo "创建" . $table_name . " 表失败. $conn->error\n";
      return 1;
    }
  }
}


// 关闭数据库连接  
$conn->close();
