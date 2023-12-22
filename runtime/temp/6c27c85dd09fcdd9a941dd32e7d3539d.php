<?php /*a:1:{s:61:"/data/test.tp.com/application/index/view/display/display.html";i:1703125792;}*/ ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Expires" content="0">
    <title>数据展示</title>
    <link rel="stylesheet" href="/static/css/layui/layui.css">
    <script src="/static/js/layui/layui.js"></script>
    <script src="/static/js/axios.min.js"></script>
    <script type="text/javascript" src="/static/js/jquery-1.5.2.min.js"></script>
    <script type="text/javascript" src="/static/js/highcharts.js"></script>
    <script type="text/javascript" src="/static/js/theme/grid.js"></script>
    <script src="/static/js/layui/js/excel.js"></script>


</head>

<body>
    <form class="layui-form my-form" lay-filter="agent_game_val" style="margin-top: 20px;">
        <div class="layui-form-item" style="margin-left: 20px;display: flex;">

            <select id="platform" name="platform" lay-filter="platform">
                <option value=""></option>
                <option value="bdds">百度-大搜</option>
                <option value="bdinfo">百度-信息流</option>
                <option value="douyin">抖音</option>
                <option value="kuaishou">快手</option>
            </select>

            <input type="number" name="reply_num" lay-verify="title" autocomplete="off" placeholder="重复次数" class="layui-input" style="margin-left: 10px;width: 100px;">

            <div class="layui-inline" id="query_time" style="margin-left: 15px;display: flex;align-items: center;justify-content: center;"
                lay-key="7">
                <div >
                    <input type="text" autocomplete="off" name="start_time" id="my-startDate"
                        class="layui-input"  placeholder="开始日期">
                </div>
                <div >-</div>
                <div class="layui-input-inline">
                    <input type="text" autocomplete="off" name="end_time" id="my-endDate"
                        class="layui-input"  placeholder="结束日期">
                </div>
            </div>


            <button type="submit" class="layui-btn" lay-submit="" lay-filter="im_get"
                >下载多次重复im</button>
            <button type="submit" class="layui-btn" lay-submit="" lay-filter="oa_get">下载多次重复oa</button>
            <button type="submit" class="layui-btn" lay-submit="" lay-filter="idfa_get"
                style="margin-right: 15px;">下载多次重复idfa</button>

            <select id="echart" name="echart" lay-filter="echart">
                <option value=""></option>
                <option value="0" data-title="line">line 折线图</option>
                <option value="1" data-title="column">column 柱状图</option>
                <option value="2" data-title="pie">pie 饼状图</option>
                <option value="3" data-title="spline">spline 平滑曲线</option>
                <option value="4" data-title="area">area 填充图</option>
                <option value="5" data-title="areaspline">areaspline 填充图</option>
                <option value="6" data-title="bar">bar 增长图</option>
                <option value="7" data-title="scatter">scatter 点位图</option>
            </select>

            <button type="submit" class="layui-btn" lay-submit="" lay-filter="echart_add">添加</button>


        </div>
    </form>

    <div id="container0">
    </div>

    <table lay-filter="downtable" lay-data="{id:'downtable'}">

</body>

</html>

<script src="/static/js/linkadmin/display.js"></script>