
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>设置-个人信息</title>
    <link rel="icon" href="/assets//status/img/favicon.ico">

    <link rel="stylesheet" type="text/css" href="/status/css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="/status/css/pages-seckillOrder.css" />
</head>

<body>
<!-- 头部栏位 -->
<!--页面顶部-->
@include("frag.index.index_top")

<script type="text/javascript" src="/status/js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
    $(function(){
        $("#service").hover(function(){
            $(".service").show();
        },function(){
            $(".service").hide();
        });
        $("#shopcar").hover(function(){
            $("#shopcarlist").show();
        },function(){
            $("#shopcarlist").hide();
        });

    })
</script>
<script type="text/javascript" src="/status/js/plugins/jquery.easing/jquery.easing.min.js"></script>
<script type="text/javascript" src="/status/js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="/status/js/plugins/jquery-placeholder/jquery.placeholder.min.js"></script>
<script type="text/javascript" src="/status/js/widget/nav.js"></script>
<script type="text/javascript" src="/status/js/plugins/birthday/birthday.js"></script>
<script type="text/javascript" src="/status/js/plugins/citypicker/distpicker.data.js"></script>
<script type="text/javascript" src="/status/js/plugins/citypicker/distpicker.js"></script>
<script type="text/javascript" src="/status/js/plugins/upload/uploadPreview.js"></script>
<script type="text/javascript" src="/status/js/pages/main.js"></script>
<script>
    $(function() {
        $.ms_DatePicker({
            YearSelector: "#select_year2",
            MonthSelector: "#select_month2",
            DaySelector: "#select_day2"
        });
    });
</script>
</body>
<!--header-->
<div id="account">
    <div class="py-container">
        <div class="yui3-g home">
            <!--左侧列表-->
            @include("frag.index.home_left")
            <!--右侧主内容-->
            <div class="yui3-u-5-6">
                <div class="body userInfo">
                    <ul class="sui-nav nav-tabs nav-large nav-primary ">
                        <li class="active"><a href="#one" data-toggle="tab">基本资料</a></li>
                        <li><a href="#two" data-toggle="tab">头像照片</a></li>
                    </ul>
                    <div class="tab-content ">
                        <div id="one" class="tab-pane active">
                            <form id="form-msg" class="sui-form form-horizontal">
                                <div class="control-group">
                                    <label for="inputName" class="control-label">昵称：</label>
                                    <div class="controls">
                                        <input type="text" id="inputName" name="email" placeholder="昵称">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="inputGender" class="control-label">性别：</label>
                                    <div class="controls">
                                        <label data-toggle="radio" class="radio-pretty inline">
                                            <input type="radio" name="gender" value="1"><span>男</span>
                                        </label>
                                        <label data-toggle="radio" class="radio-pretty inline">
                                            <input type="radio" name="gender" value="2"><span>女</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="inputPassword" class="control-label">生日：</label>
                                    <div class="controls">
                                        <select id="select_year2" rel="1990"></select>年
                                        <select id="select_month2" rel="4"></select>月
                                        <select id="select_day2" rel="3"></select>日
                                    </div>
                                </div>


                                <div class="control-group">
                                    <label for="inputPassword" class="control-label">所在地：</label>
                                    <div class="controls">
                                        <div data-toggle="distpicker">
                                            <div class="form-group area">
                                                <select class="form-control" id="province1"></select>
                                            </div>
                                            <div class="form-group area">
                                                <select class="form-control" id="city1"></select>
                                            </div>
                                            <div class="form-group area">
                                                <select class="form-control" id="district1"></select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="inputJob" class="control-label">职业：</label>
                                    <div class="controls"><span class="sui-dropdown dropdown-bordered select"><span class="dropdown-inner"><a role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
                                                    <input name="job" type="hidden" data-rules="required"><i class="caret"></i><span>请选择</span></a>
                                            <ul id="menu4" role="menu" aria-labelledby="drop4" class="sui-dropdown-menu">
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="bj">程序员</a></li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="sb">产品经理</a></li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="sb">UI设计师</a></li>
                                            </ul>
                                            </span>
                                            </span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="sanwei" class="control-label"></label>
                                    <div class="controls">
                                        <button type="submit" class="sui-btn btn-primary">立即注册</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="two" class="tab-pane">

                            <div class="new-photo">
                                <p>当前头像：</p>
                                <div class="upload">
                                    <img id="imgShow_WU_FILE_0" width="100" height="100" src="/status/img/_/photo_icon.png" alt="">
                                    <input type="file" id="up_img_WU_FILE_0" />
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- 底部栏位 -->
<!--页面底部-->
@include("frag.index.index_foot")
<!--页面底部END-->

undefined

</html>