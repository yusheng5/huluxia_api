$(document).ready(function(){
    var domain = document.domain;

    $("#login").click(function(){
        var user = $("#inputAccount").val();
        var pass = $("#inputpwd").val();
        var data = {
            user:user,
            pass:pass,
        };
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content'),
            }
        });
        $.ajax({
            type:"POST",
            url:"/user/login",
            data:data,
            success:function (data,status,xhr) {
                data = $.parseJSON(data);
                console.log('小伙子，如果你看到这条信息.那么证明我们有缘,不妨加入我们这边的大家庭.一起做题可否? ');
                console.log('点击链接,加入我们!https://jq.qq.com/?_wv=1027&k=5BFgNyN');
                switch (data['status']) {
                    case 404:
                        new $.zui.Messager(data['msg'],{
                            type:"danger",
                        }).show();
                        break;
                    case 200:
                        new $.zui.Messager(data['msg'],{
                            type:"success",
                        }).show();
                        window.location.href = domain + '/user/info';
                        break;
                }
            },
            error:function (data) {
                var data = data['responseText'];
                var data = $.parseJSON(data)['errors'];
                new $.zui.Messager(data['pass']+data['user'], {
                    type: 'warning' // 定义颜色主题
                }).show();
            }
        });
    });
});