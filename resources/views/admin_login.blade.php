
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>后台登录</title>
    <meta name="author" content="DeathGhost" />
    <link rel="stylesheet" type="text/css" href="/status/style.css" />
    <style>
        body{height:100%;background:#16a085;overflow:hidden;}
        canvas{z-index:-1;position:absolute;}
    </style>
    <script src="/status/js/jquery.js"></script>
    <script src="/status/js/verificationNumbers.js"></script>
    <script src="/status/js/Particleground.js"></script>
    <script src="/status/layui/layui.js"></script>
    <script>
        $(document).ready(function() {
            //粒子背景特效
            $('body').particleground({
                dotColor: '#5cbdaa',
                lineColor: '#5cbdaa'
            });
            //验证码
            createCode();
            //测试提交，对接程序删除即可
            $(".submit_btn").click(function(){
                location.href="index.html";
            });
        });
    </script>
</head>
<body>
<dl class="admin_login">
    <dt>
        <strong>站点后台管理系统</strong>
        <em>Management System</em>
    </dt>
    <dd class="user_icon">
        <input type="text" placeholder="账号" id="admin_name" class="login_txtbx"/>
    </dd>
    <dd class="pwd_icon">
        <input type="password" placeholder="密码" id="admin_pwd" class="login_txtbx"/>
    </dd>
    <dd>
        <input type="button" id="but" value="立即登陆" class="button"/>
    </dd>
    <dd>
        <p>© 2015-2016 DeathGhost 版权所有</p>
        <p>陕B2-20080224-1</p>
    </dd>
</dl>
</body>
</html>
<style>
    .button{
        width:100%;height:42px;border:none;font-size:16px;background:#048f74;color:#f8f8f8;
        background:#0c9076;color:#f4f4f4;
    }
</style>
<script>
    $(document).on("click","#but",function(){
        var admin_name = $("#admin_name").val();
        if(admin_name==""){
            alert("不能为空");
        }
        var admin_pwd = $("#admin_pwd").val();
        if(admin_name==""){
            alert("不能为空");
        }
        $.ajax({
            url : "/admin_login_do",
            data : {admin_name:admin_name,admin_pwd:admin_pwd},
            dataType : "json",
            type : "post",
            success:function(res){
                if(res.code==0000){
                    alert(res.message)
                }else{
                    location.href="/admin/brand"
                }
            }
        })
    })
</script>

