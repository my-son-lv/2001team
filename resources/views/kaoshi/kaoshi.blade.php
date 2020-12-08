<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bootstrap 实例 - 水平表单</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
@php dump(session("session")); @endphp
<form class="form-horizontal" role="form">
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">账号：</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="zhanghao" placeholder="账号">
        </div>
    </div>

    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">密码：</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="mima" placeholder="密码">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="button" id="but" class="btn btn-default">登录</button>
        </div>
    </div>
</form>

</body>
</html>
<script>
    $(document).on("click","#but",function(){
        var zhanghao = $("#zhanghao").val();
        var mima = $("#mima").val();
        $.ajax({
            url : "/kaoshi_do",
            data : {zhanghao:zhanghao,mima:mima},
            dataType : "json",
            type : "post",
            success:function(res){
                if(res.code==0000){
                    location.href="/aaaa";
                    alert(res.message)
                }
            }
        })
    })
</script>