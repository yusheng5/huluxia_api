function timestampToTime(timestamp) {
    var date = timestamp;//时间戳为10位需*1000，时间戳为13位的话不需乘1000
    var Y = date.getFullYear() + '-';
    var M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
    var D = date.getDate() + ' ';
    var h = date.getHours() + ':';
    var m = date.getMinutes() + ':';
    var s = date.getSeconds();
    return Y+M+D+h+m+s;
}
function user_info() {
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content'),
        }
    });
    $.ajax({
        url:"/admin/reply_user",
        async:true,
        success:function (result) {
            console.log(result);
            for (var i =0;i<result.length;i++){
            $("#content").append("<div class=\"items\">\n" +
                "  <div class=\"item\">\n" +
                "    <div class=\"item-heading\">\n" +
                "      <div class=\"pull-right label label-success\">"+result[i]['content']['category']['title']+"</div>\n" +
                "      <h4><a href=\"###\"></a></h4>\n" +
                "    </div>\n" +
                "    <div class=\"item-content\">"+result[i]['content']['text']+"</div>\n" +
                "    <div class=\"item-footer\">\n" +
                "       &nbsp; <span class=\"text-muted\">"+
                   new Date(result[i]['content']['createTime'])
                +"</span>\n" +
                "    </div>\n" +
                "  </div>\n" +
               "</div>");
            console.log(result[i]['content']['createTime'] / 1000);
            console.log(new Date(result[i]['content']['createTime']));
            }
        },
        error:function (status,result) {
            alert("错误");
        },
        type:"POST",
    });
}
