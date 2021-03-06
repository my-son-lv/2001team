
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>个人注册</title>


    <link rel="stylesheet" type="text/css" href="/status/css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="/status/css/pages-register.css" />
</head>

<body>
<div class="register py-container ">
    <!--head-->
    <div class="logoArea">
        <a href="" class="logo"></a>
    </div>
    <!--register-->
    <div class="registerArea">
        <h3>注册新用户<span class="go">我有账号，去<a href="/login">登录</a></span></h3>
        <div class="info">
            <form class="sui-form form-horizontal ddform" >
                <div class="control-group">
                    <label class="control-label">用户名：</label>
                    <div class="controls">
                        <input type="text" name="user_name" placeholder="请输入你的用户名" class="input-xfat input-xlarge">
                        <span id="user_name_span" style="color:red;"></span>
                    </div>
                </div>
                <div class="control-group">
                    <label for="inputPassword" class="control-label">登录密码：</label>
                    <div class="controls">
                        <input type="password" name="user_pwd" placeholder="设置登录密码" class="input-xfat input-xlarge">
                        <span id="user_pwd_span" style="color:red;"></span>
                    </div>
                </div>
                <div class="control-group">
                    <label for="inputPassword" class="control-label">确认密码：</label>
                    <div class="controls">
                        <input type="password" name="user_pwds" placeholder="再次确认密码" class="input-xfat input-xlarge">
                        <span id="user_pwds_span" style="color:red;"></span>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">手机号：</label>
                    <div class="controls box">
                        <input type="text" name="user_tel" placeholder="请输入你的手机号" class="input-xfat input-xlarge">
                        <button type="button" class="btn btn-primary" id="code">获取验证码</button>
                        <span id="user_tel_span" style="color:red;"></span>
                    </div>
                </div>
                <div class="control-group">
                    <label for="inputPassword" class="control-label">短信验证码：</label>
                    <div class="controls">
                        <input type="text" name="user_code" placeholder="短信验证码" class="input-xfat input-xlarge">
                    </div>
                </div>

                <div class="control-group">
                    <label for="inputPassword" class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <div class="controls">
                        <input name="m1" type="checkbox" value="2" checked=""><span>同意协议并注册《品优购用户协议》</span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"></label>
                    <button type="button" class="sui-btn btn-block btn-xlarge btn-danger" id="but">
                      完成注册
                    </button>
                </div>
            </form>
            <div class="clearfix"></div>
        </div>
    </div>
    <!--foot-->
    <div class="py-container copyright">
        <ul>
            <li>关于我们</li>
            <li>联系我们</li>
            <li>联系客服</li>
            <li>商家入驻</li>
            <li>营销中心</li>
            <li>手机品优购</li>
            <li>销售联盟</li>
            <li>品优购社区</li>
        </ul>
        <div class="address">地址：北京市昌平区建材城西路金燕龙办公楼一层 邮编：100096 电话：400-618-4000 传真：010-82935100</div>
        <div class="beian">京ICP备08001421号京公网安备110108007702
        </div>
    </div>
</div>


<script type="text/javascript" src="/status/js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="/status/js/plugins/jquery.easing/jquery.easing.min.js"></script>
<script type="text/javascript" src="/status/js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="/status/js/plugins/jquery-placeholder/jquery.placeholder.min.js"></script>
<script type="text/javascript" src="/status/js/pages/register.js"></script>
</body>

</html>
<script>    
    //验证
    $(function(){
        $("input[name='user_name']").blur(function(){
            var user_name = $("input[name='user_name']").val();
            if(user_name==''){
                $("#user_name_span").text('用户名不能为空');
            }else{
                $("#user_name_span").text('');
            }
        });
        $("input[name='user_pwd']").blur(function(){
            var user_pwd = $("input[name='user_pwd']").val();
            if(user_pwd==''){
                $("#user_pwd_span").text('密码不能为空');
            }
        });
        $("input[name='user_pwds']").blur(function(){
            var user_pwds = $("input[name='user_pwds']").val();
            var user_pwd = $("input[name='user_pwd']").val();
            if(user_pwds==''){
                $("#user_pwds_span").text('请输入确认密码');
            }else if(user_pwd!==user_pwds){
                $("#user_pwds_span").text('密码与确认密码不一致');
            }
        });
    })
    //ajax提交
    $(document).on('click','#but',function(){
        var data = $("form").serialize();
        var url = "http://www.2001api.com/api/regstore?callback=?";

        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.getJSON(url,data,function(res){
            // alert(res.msg);
                if(res.code=='0000'){
                    alert(res.msg+',请登录');
                    location.href='/login';
                }else{
                    alert(res.msg);
                }
            })

    })
    //倒计时
    $(document).on('click','#code',function(){
        var timer = null;
        var count = 60;
        $('.box>button').click(function() {
            var codeText = $('.code').text();
            if (codeText == '获取验证码') {
                timer = setInterval(function(){
                    count--;
                    $('.code').text(count+'后获取验证码');
                    if (count <=0) {
                        clearInterval(timer);
                        $('.code').text('获取验证码');
                    }
                },1000);
            }
        });
    })
    //获取短信验证码
    // $(document).on('click','#code',function(){
    //     var user_tel = $("input[name='user_tel']").val();
    //     // alert(user_tel);
    //     // alert(user_url);return;
    //     var url = "http://www.2001api.com/api/sendcode?callback=?";
    //     $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    //     $.getJSON(url,{user_tel:user_tel},function(res){
    //             console.log(res);
    //             if(res.code=='0000'){
                    
    //             }
    //         });
    // })
</script>
