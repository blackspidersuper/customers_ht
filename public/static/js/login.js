layui.use(['form'], function () {
    var form = layui.form,
        layer = layui.layer;

    // 登录过期的时候，跳出ifram框架
    if (top.location != self.location) top.location = self.location;

    // 粒子线条背景
    $(document).ready(function () {
        $('.layui-container').particleground({
            dotColor: '#7ec7fd',
            lineColor: '#7ec7fd'
        });
    });
});

// 进行登录操作
function sub() {
    var username = $("input[name='username']").val();
    var password = $("input[name='password']").val();
    if (username == '') {
        layer.msg('用户名不能为空');
        return false;
    }
    if (password == '') {
        layer.msg('密码不能为空');
        return false;
    }

    $.post('/tologin', {
        username: username,
        password: password,
    }, function (data) {

        if (data.code == '1') {
            window.location.href = '/';
        }else{
            layer.msg(data.msg);
            return false;
        }
    });
}



