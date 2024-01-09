
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

    //初始化数据（统计报表列表）
    table.render({
        elem: '#customer_list'
        , id: 'customer_list'
        , cols: [[ //表头
            { field: 'im', title: '点数1', align: 'center', templet: '#im' },
            { field: 'oa', title: '点数2', align: 'center', templet: '#oa' },
            { field: 'id', title: '点数3', align: 'center', templet: '#id' },
        ]],
        data: []

    });

    var demo1 = xmSelect.render({
        el: '#demo1',
        data: [
            { name: '有效触点', value: 1 },
            { name: '视频播放', value: 2 },
            { name: '视频播完', value: 3 },
            { name: '视频有效播', value: 4 },
        ]
    })

    form.on('select(platform)', function (data) {
        if (data.value == 'douyin') {
            $('#demo1').show();
        } else {
            $('#demo1').hide();
            demo1.setValue([])
        }
    });


    form.on('submit(search)', function (data) {
        var key_dy = '';
        if (data.field.platform == "") {
            layer.msg("请选择添加的平台");
            return false;
        }

        if (data.field.platform == 'douyin' && data.field.select) {
            key_dy = data.field.select;
        }

        table.reload('customer_list', {
            where: {
                type_pallet: data.field.platform,
                key: key_dy,
                start_time: data.field.start_time,
                end_time: data.field.end_time,
                uid_id: data.field.xm_client,
            },
            url: "/display/down_list1",
        });
        layui.form.render();
        return false;

    });

    //创建下载
    table.on('tool(customer_list)', function (obj) {
        var down_event = obj.event;
        var down_data = obj.data[down_event + '_data'];

        let now_time = layui.util.toDateString(new Date().getTime(), 'yyyy-MM-dd HH:mm:ss');

        let title_name = $('#platform option:selected')[0].innerText;//获取标题名称
        var outData = layui.excel.filterExportData(down_data, ['name',down_event,'add_time']);
        outData.unshift({name: '类型',add_time: '添加时间',down_event: title_name +'_' +down_event })
        layui.excel.exportExcel(outData, title_name + '_' + down_event + '_导出-' + now_time + '.csv', 'csv');


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





});