
layui.config({
    base: '/static/js/layui/js/'
}).extend({
    xmSelect: 'xm-select',
}).use(['table', 'jquery', 'form', 'layer', 'xmSelect', 'laydate'], function () {
    var table = layui.table;
    window.$ = layui.$;
    var form = layui.form;
    var layer = layui.layer;
    var laydate = layui.laydate;

    //定义一下初始数据时间
    var init_startDate = layui.util.toDateString(new Date(new Date().getTime() - 5 * 24 * 60 * 60 * 1000).getTime(), "yyyy-MM-dd 00:00:00"),
        init_endDate = layui.util.toDateString(new Date().getTime(), 'yyyy-MM-dd 23:59:59');

    //时间(默认最近七天)
    $('#my-startDate').attr('value', init_startDate);
    $('#my-endDate').attr('value', init_endDate);
    laydate.render({
        elem: '#query_time'
        , range: ['#my-startDate', '#my-endDate']
        , min: minDate()
        , max: maxDate()
        , type: 'datetime'
    });

    //一进来先缓存一下数据
    axios({
        method: 'get',
        url: '/display/show_list_display'
    }).then(function (response) {
        window.list_display = response.data;
    });


    // 设置最大可选的日期
    function maxDate() {
        var now = new Date();
        return now.getFullYear() + "-" + (now.getMonth() + 1) + "-" + now.getDate();
    }

    // 设置最小可选的日期
    function minDate() {
        var now = new Date();
        var fiveDaysAgo = new Date(now.getTime() - 5 * 24 * 60 * 60 * 1000);
        return fiveDaysAgo.getFullYear() + "-" + (fiveDaysAgo.getMonth() + 1) + "-" + fiveDaysAgo.getDate();
    }


    //点击提交
    form.on('submit(im_get)', function (data) {

        if (data.field.platform == "") {
            layer.msg("请选择添加的平台");
            return false;
        }
        axios({
            method: 'post', url: '/display/down_list',
            params: {
                type_pallet: data.field.platform,
                key: 'imei',
                start_time: data.field.start_time,
                end_time: data.field.end_time,
                reply_num: data.field.reply_num,
                uid_id: data.field.xm_client,
            }
        }).then(function (response) {

            if (response.data.code == 1) {
                layer.msg(response.data.msg);
                return false;
            }
            let title_name = $('#platform option:selected')[0].innerText;//获取标题名称
            var outData = layui.excel.filterExportData(response.data.data, ['imei']);
            outData.unshift({ imei: title_name + 'imei' })
            layui.excel.exportExcel(outData, title_name + 'im导出.txt', 'txt');
        });
        return false;
    });

    //点击提交
    form.on('submit(oa_get)', function (data) {

        if (data.field.platform == "") {
            layer.msg("请选择添加的平台");
            return false;
        }
        axios({
            method: 'post', url: '/display/down_list',
            params: {
                type_pallet: data.field.platform,
                key: 'oaid',
                start_time: data.field.start_time,
                end_time: data.field.end_time,
                reply_num: data.field.reply_num,
                uid_id: data.field.xm_client,
            }
        }).then(function (response) {

            if (response.data.code == 1) {
                layer.msg(response.data.msg);
                return false;
            }
            let title_name = $('#platform option:selected')[0].innerText;//获取标题名称
            var outData = layui.excel.filterExportData(response.data.data, ['oaid']);
            outData.unshift({ oaid: title_name + 'oaid' })
            layui.excel.exportExcel(outData, title_name + 'oa导出.txt', 'txt');
        });
        return false;
    });

    //点击提交
    form.on('submit(idfa_get)', function (data) {

        if (data.field.platform == "") {
            layer.msg("请选择添加的平台");
            return false;
        }
        axios({
            method: 'post', url: '/display/down_list',
            params: {
                type_pallet: data.field.platform,
                key: 'idfa',
                start_time: data.field.start_time,
                end_time: data.field.end_time,
                reply_num: data.field.reply_num,
                uid_id: data.field.xm_client,
            }
        }).then(function (response) {

            if (response.data.code == 1) {
                layer.msg(response.data.msg);
                return false;
            }
            let title_name = $('#platform option:selected')[0].innerText;//获取标题名称
            var outData = layui.excel.filterExportData(response.data.data, ['idfa']);
            outData.unshift({ idfa: title_name + 'idfa' })
            layui.excel.exportExcel(outData, title_name + 'id导出.txt', 'txt');
        });
        return false;
    });


    var chart;

    //点击提交
    form.on('submit(echart_add)', function (data) {

        var selectedOption = $('#echart option:selected'); //获取下拉框选择状态

        if (data.field.echart == "") {
            layer.msg("请选择添加的图像");
            return false;
        }

        var title = selectedOption.data('title');//获取图标类型
        var title_name = $('#echart option:selected')[0].innerText;//获取标题名称
        var toId = 'container' + data.field.echart //设置div的id

        show_chart(toId, title, window.list_display, title_name);
        return false;
    });


   var chart;

    //点击提交
    form.on('submit(echart_add)', function (data) {

        var selectedOption = $('#echart option:selected'); //获取下拉框选择状态

        if (data.field.echart == "") {
            layer.msg("请选择添加的图像");
            return false;
        }

        var title = selectedOption.data('title');//获取图标类型
        var title_name = $('#echart option:selected')[0].innerText;//获取标题名称
        var toId = 'container' + data.field.echart //设置div的id

        show_chart(toId, title, window.list_display, title_name);
        return false;
    });


    //展示图表
    function show_chart(toId, type, list_data, title_name) {

        var aaa = [
            ['杭州', 45.0],
            ['江西', 26.8],
            ['湖南', 12.8], //选中状态
            ['北京', 8.5],
            ['上海', 6.2],
            ['深圳', 0.7]
        ]

        if (type == 'pie') {
            var data = [{ data: list_data.pie_chart }]
        } else {
            var data = list_data.other_chart
        }

        //如果不存在就先创建一个div
        if ($('#' + toId).length == 0) {
            $('body').append('<div id="' + toId + '"></div>');
        }

        var logset = {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: true//是否显示title
        }


        // line 折线图,column 柱状图,pie 饼状图,spline 平滑曲线,area 填充图,areaspline 填充图,bar 增长图,scatter 点位图
        chart = new Highcharts.Chart({
            chart: {
                renderTo: toId,          //放置图表的容器
                plotBackgroundColor: null,
                plotBorderWidth: null,
                defaultSeriesType: type
            },
            title: {
                text: title_name
            },

            xAxis: {//X轴数据
                categories: list_data.date,
                labels: {
                    rotation: -45, //字体倾斜
                    align: 'right',
                    style: { font: 'normal 13px 宋体' }
                }
            },
            yAxis: {//Y轴显示文字
                title: {
                    text: '使用条数'
                }
            },
            tooltip: {
                enabled: true,
                formatter: function () {
                    return '<b>' + this.x + '</b><br/>' + this.series.name + ': ' + Highcharts.numberFormat(this.y, 1);
                }
            },
            plotOptions: {
                line: type == 'pie' ? {} : logset, //其他图标的
                column: type == 'pie' ? logset : {} //饼状图
            },
            series: data, //饼图的数据和其他图表不一样
        });
    }






});