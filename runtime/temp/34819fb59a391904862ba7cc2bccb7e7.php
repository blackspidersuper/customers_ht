<?php /*a:1:{s:51:"/data/test.tp.com/application/index/view/index.html";i:1703046476;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>系统</title>
    <meta name="keywords" content="  后台管理">
    <meta name="description" content="  后台管理">
    <link rel="icon" href="/favicon.ico">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">

    <link rel="stylesheet" href="/static/css/layui/layui.css" media="all">
    <link rel="stylesheet" href="/static/css/layui/layuimini.css?v=2.0.4.2" media="all">
    <link rel="stylesheet" href="/static/css/default.css" media="all">
    <link rel="stylesheet" href="/static/css/font-awesome.min.css" media="all">
    <script src="/static/js/layui/layui.js" charset="utf-8"></script>
    <script src="/static/js/layui/lay-config.js?v=2.0.0" charset="utf-8"></script>
    
    <style id="layuimini-bg-color">
    </style>
    <link id="layuicss-layer" rel="stylesheet" href="/static/css/layui/layer.css?v=3.1.1" media="all">
</head>

<body class="layui-layout-body layuimini-all">
    <div class="layui-layout layui-layout-admin">

        <div class="layui-header header">
            <div class="layui-logo layuimini-logo" ></div>

            <div class="layuimini-header-content">
                <a>
                    <div class="layuimini-tool"><i title="展开" class="fa fa-outdent" data-side-fold="1"></i></div>
                </a>

                <!--电脑端头部菜单xx-->
                <!-- <ul class="layui-nav layui-layout-left layuimini-header-menu layuimini-menu-header-pc layuimini-pc-show">
            </ul> -->


                <ul class="layui-nav layui-layout-left layuimini-header-menu">
                    <li class="layui-nav-item menu-li undefined layui-this">
                        <span class="layui-left-nav"
                            style="font-size: 18px;font-weight:bold;color: #fb0000;">账户禁止出借他人操作</span>
                    </li>
                </ul>

                <!--手机端头部菜单-->
                <ul class="layui-nav layui-layout-left layuimini-header-menu layuimini-mobile-show">
                    <li class="layui-nav-item">
                        <a href="javascript:;"><i class="fa fa-list-ul"></i> 查看</a>
                        <dl class="layui-nav-child layuimini-menu-header-mobile">
                        </dl>
                    </li>
                </ul>

                <ul class="layui-nav layui-layout-right">

               
                    <li class="layui-nav-item mobile layui-hide-xs" lay-unselect>
                        <a href="javascript:;" data-check-screen="full"><i class="fa fa-arrows-alt"></i></a>
                    </li>
                    <li class="layui-nav-item layuimini-setting">
                        <a href="javascript:;"><?php echo htmlentities($username); ?></a>
                        <dl class="layui-nav-child">
                            <dd>
                                <a href="javascript:;" class="login-out">退出登录</a>
                            </dd>
                        </dl>
                    </li>
                
                </ul>
            </div>
        </div>

        <!--无限极左侧菜单-->
        <div class="layui-side layui-bg-black layuimini-menu-left">
        </div>

        <!--初始化加载层-->
        <div class="layuimini-loader">
            <div class="layuimini-loader-inner"></div>
        </div>

        <!--手机端遮罩层-->
        <div class="layuimini-make"></div>

        <!-- 移动导航 -->
        <div class="layuimini-site-mobile"><i class="layui-icon"></i></div>

        <div class="layui-body">

            <div class="layuimini-tab layui-tab-rollTool layui-tab" lay-filter="layuiminiTab" lay-allowclose="true">
                <ul class="layui-tab-title">
                    <li class="layui-this" id="layuiminiHomeTabId" lay-id=""></li>
                </ul>
                <div class="layui-tab-control">
                    <li class="layuimini-tab-roll-left layui-icon layui-icon-left"></li>
                    <li class="layuimini-tab-roll-right layui-icon layui-icon-right"></li>
                    <li class="layui-tab-tool layui-icon layui-icon-down">
                        <ul class="layui-nav close-box">
                            <li class="layui-nav-item">
                                <a href="javascript:;"><span class="layui-nav-more"></span></a>
                                <dl class="layui-nav-child">
                                    <dd><a href="javascript:;" layuimini-tab-close="current">关 闭 当 前</a></dd>
                                    <dd><a href="javascript:;" layuimini-tab-close="other">关 闭 其 他</a></dd>
                                    <dd><a href="javascript:;" layuimini-tab-close="all">关 闭 全 部</a></dd>
                                </dl>
                            </li>
                        </ul>
                    </li>
                </div>
                <div class="layui-tab-content">
                    <div id="layuiminiHomeTabIframe" class="layui-tab-item layui-show"></div>
                </div>
            </div>

        </div>
    </div>

    <div id="enter_show" style="display: none;">
        <div style="font-size: 18px;">
        你好
        </br>
    </div>

    </div>

    <script src="/static/js/index.js"></script>
</body>

</html>