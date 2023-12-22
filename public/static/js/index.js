layui.use(['jquery', 'layer', 'miniAdmin', 'miniTongji'], function () {
    var $ = layui.jquery,
        layer = layui.layer,
        miniAdmin = layui.miniAdmin;


    var options = {
        iniUrl: "/admin_page",    // 初始化接口
        urlHashLocation: false,      // 是否打开hash定位
        bgColorDefault: false,      // 主题默认配置
        multiModule: true,          // 是否开启多模块
        menuChildOpen: true,       // 是否默认展开菜单
        loadingTime: 0,             // 初始化加载时间
        pageAnim: false,             // iframe窗口动画
        maxTabNum: 10,              // 最大的tab打开数量
    };

    miniAdmin.render(options)
    
    setTimeout(() => {
        $(".layui-logo img").remove();//删除后台管理标签旁边的图片
    }, 1000);
    
    //退出登录
    $('.login-out').on("click", function () {
        $.getJSON('/logout', function (res) {
            if (res.code == 1) {
                window.location.href = '/login';
            } else {
                layer.msg(res.msg);
            }
        })
    });

});


function reload() {  //刷新
    //xadmin.del_tab();//关闭所有层
    location.reload();  //刷新
}