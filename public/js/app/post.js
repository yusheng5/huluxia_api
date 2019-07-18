function isEmpty(obj){
    if(typeof obj == "undefined" || obj == null || obj == ""){
        return true;
    }else{
        return false;
    }
}
function huifu(comment_id,post_id)
{
        var text = $("#text").val();
        var url = $('meta[name="huifu"]').attr('content');
        if (isEmpty(text))
        {
            new $.zui.Messager('回复内容不可为空', {
                type: 'warning' // 定义颜色主题
            }).show();
        }
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content'),
        }
    });
        $.ajax({
            url:url,
            jsonp:'callback',
            jsonpCallback:"show",
            async:true,
            type:"POST",
            data:{
                comment_id:comment_id,
                post_id:post_id,
                text:text,
            },
            dataType:"jsonp",
            success:function (result) {
            },
            error:function (res) {
                location.reload();
            }
        })
}
function show(result) {
    console.log("回答成功",result);
}