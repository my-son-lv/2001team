<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
    <title>砍价商品</title>
    <link rel="stylesheet" type="text/css" href="/status/css/webbase.css"/>
    <link rel="stylesheet" type="text/css" href="/status/css/pages-item.css"/>
    <link rel="stylesheet" type="text/css" href="/status/css/pages-zoom.css"/>
    <link rel="stylesheet" type="text/css" href="/status/css/widget-cartPanelView.css"/>
</head>
<body>
<!-- 头部栏位 -->
<style>
    h1 {
        font-family:"微软雅黑";
        font-size:40px;
        margin:20px 0;
        border-bottom:solid 1px #ccc;
        padding-bottom:20px;
        letter-spacing:2px;
    }
    .time-item strong {
        background:#C71C60;
        color:#fff;
        line-height:49px;
        font-size:36px;
        font-family:Arial;
        padding:0 10px;
        margin-right:10px;
        border-radius:5px;
        box-shadow:1px 1px 3px rgba(0,0,0,0.2);
    }
    #day_show {
        float:left;
        line-height:49px;
        color:#c71c60;
        font-size:32px;
        margin:0 10px;
        font-family:Arial,Helvetica,sans-serif;
    }
    .item-title .unit {
        background:none;
        line-height:49px;
        font-size:24px;
        padding:0 10px;
        float:left;
    }
</style>
<style>
    * {
        margin:0;
        padding:0;
    }
    .scroll-box {
        width:400px;
        height:200px;
        border:2px solid #000;
        margin:20px auto;
        overflow:hidden;
    }
    .scroll-box ul {
        list-style:none;
        width:100%;
        height:100%;
    }
    .scroll-box ul li {
        width:100%;
        height:40px;
        box-sizing:border-box;
        line-height:40px;
        text-align:center;
    }

</style>
<!--页面顶部-->
@include("frag.index.index_top")
<div class="py-container">
    <div id="item">
        <div class="product-info">
            <div class="fl preview-wrap">
                <!--放大镜效果-->
                <div class="zoom">
                    <!--默认第一个预览-->
                    <div id="preview" class="spec-preview">
                        <span class="jqzoom"><img src="{{env('JUSTME_URL')}}{{$barg_goods["goods_img"]}}" style="width: 400px;height: 400px"/></span>
                    </div>
                </div>
            </div>
            <div class="fr itemInfo-wrap">
                <div class="sku-name">
                    <h4>{{$barg_goods["goods_name"]}}</h4>
                    <input type="hidden" id="barg_id" value="{{$barg_goods["barg_id"]}}">
                </div>
                <div class="news"></div>
                <div class="summary">
                    <div class="summary-wrap">
                        <div class="fl title">
                            <i style="font-size:15pt;">原　　价：</i><br>
                            <i style="font-size:15pt;">剩余库存：<span id="cut_number">{{$barg_goods["cut_number"]}}</span>件</i>
                        </div>
                        <div class="fl price">
                            <i style="font-size:18pt;">¥</i>
                            <em>
                                <span id="span" style="font-size:18pt; text-decoration: line-through">
                                    <b>{{$barg_goods["present_price"]}}.00元</b>
                                </span>&nbsp;
                                <span class="xian hidden" style="font-size:18pt;">
                                    <i style="font-size:15pt;color: #0C0C0C">现　　价：</i>
                                    <i style="font-size:18pt;">¥</i>
                                    <b>{{$barg_goods["cut_price"]}}.00元</b>
                                </span>
                            </em>
                        </div>
                    </div>
                </div>
                <div class="clearfix choose">
                    <div class="summary-wrap">
                        <div class="fl">
                            <ul class="btn-choose unstyled">
                                <li>
                                    @if($user_id==null)
                                    <button id="cut" class="sui-btn btn-danger addshopcar">砍价</button>
                                        @else
                                        <button id="cuts" class="sui-btn btn-danger addshopcar">帮砍</button>
                                    @endif
                                </li><br>
                                <div class="scroll-box">
                                    <ul>
                                        @if(!count($data))
                                            <p>暂无数据...</p>
                                        @else
                                            @foreach($data as $v)
                                                <li>用户:{{$v->user_name}}-----砍掉:{{$v->barg_user_price}}元</li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                                <p></p><span class="tishi hidden">右侧文本框有地址！您可以把地址分享给好友</span>
                                <li class="bangkan hidden">
                                    <button class="sui-btn btn-danger addshopcar">帮砍</button>
                                </li>
                                <span class="tishis hidden"><input type="text" id="urls"></span>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--product-detail-->
        <!--like-->
        <div class="clearfix"></div>
    </div>
</div>


<script>

</script>
<!-- 底部栏位 -->
<!--页面底部-->
@include("frag.index.index_foot")
<!--页面底部END-->
<script>
    window._bd_share_config = {
        common : {
            bdText : '123',
            bdDesc : '123',
            bdUrl : '自定义分享url地址',
            bdPic : '自定义分享图片',
        },
        share : [{
            "bdSize" : 16
        }],
        slide : [{
            bdImg : 0,
            bdPos : "right",
            bdTop : 100
        }],
        image : [{
            viewType : 'list',
            viewPos : 'top',
            viewColor : 'black',
            viewSize : '16',
            viewList : ['qzone','tsina','huaban','tqq','renren']
        }],
        selectShare : [{
            "bdselectMiniList" : ['qzone','tqq','kaixin001','bdxc','tqf']
        }]
    };
    with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
</script>
<script>
    $(function() {
        //获得当前<ul>
        var $uList = $(".scroll-box ul");
        var timer = null;
        //触摸清空定时器
        $uList.hover(function() {
                    clearInterval(timer);
                },
                function() { //离开启动定时器
                    timer = setInterval(function() {
                                scrollList($uList);
                            },
                            1000);
                }).trigger("mouseleave"); //自动触发触摸事件
        //滚动动画
        function scrollList(obj) {
            //获得当前<li>的高度
            var scrollHeight = $("ul li:first").height();
            //滚动出一个<li>的高度
            $uList.stop().animate({
                        marginTop: -scrollHeight
                    },
                    600,
                    function() {
                        //动画结束后，将当前<ul>marginTop置为初始值0状态，再将第一个<li>拼接到末尾。
                        $uList.css({
                            marginTop: 0
                        }).find("li:first").appendTo($uList);
                    });
        }
    });
</script>
<script>
    $(document).on("click","#cut",function(){
        if(confirm("确认砍价么？")){
            var barg_id = $("#barg_id").val();
            if(isNaN(barg_id)){
                alert("系统错误");return
            }
            var cut_number = $("#cut_number").text();
            var cut_num = parseInt(cut_number);
            if(isNaN(cut_num)){
                alert("系统错误");return
            }
            if(cut_num==0){
                alert("余库不足");
                return
            }else{
                cut_num = cut_num-1;
                $("#cut_number").html(cut_num);
            }
            $.ajax({
                url : "/index/brag_do",
                data : {barg_id:barg_id},
                dataType : "json",
                type : "post",
                success:function(res){
                    if(res.code==0002){
                        if(confirm(res.message)){
                            window.location.href="/login";
                        }
                        return
                    }
                    if(res.code==0000){
                        alert(res.message);
                        var url=window.location.href;
                        var user_id = url.substr(url.length-1);//优化
                        if(res.user_id==user_id){//登录用户的id和浏览器上的id对比如果有那就不显示砍价没有显示帮砍
//                            if($("#hidden").hasClass("hidden")){
                                $("#cut").addClass("hidden");
                                $(".time-item").removeClass("hidden");
                                $(".xian").removeClass("hidden");
                                $('<style>').html("text-decoration: line-through").appendTo("head");
                                $(".tishi").removeClass("hidden");
                                $(".tishis").removeClass("hidden");
                                $("#urls").val(res.urls);
//                            }
                        }else{
//                            if($("#hidden").hasClass("hidden")){
                                $("#cut").addClass("hidden");
                                $(".time-item").removeClass("hidden");
                                $(".xian").removeClass("hidden");
                                $('<style>').html("text-decoration: line-through").appendTo("head");
                                $(".bdsharebuttonbox").removeClass("hidden");
//                            }
                        }
                    }else{
                        alert(res.message)
                    }
                }
            })
        }
    })
</script>
<script>
    $(document).on("click","#cuts",function(){
        var barg_id = $("#barg_id").val();
        var user_url=window.location.href;
        var user_id = user_url.substr(user_url.length-1);//优化
        $.ajax({
            url : "/user_brag_do",
            data : {barg_id:barg_id,user_id:user_id},
            dataType : "json",
            type : "post",
            success:function(res){
                if(res.code==0002){
                    if(confirm("还没有登录，是否前往登录")){
                        location.href=res.url
                    }
                }
                if(res.code==0000){
                    alert(res.message);
                    location.href=res.url
                }else{
                    alert(res.message);
                }
            }
        })
    })
</script>
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
<script type="text/javascript" src="/status/js/model/cartModel.js"></script>
<script type="text/javascript" src="/status/js/plugins/jquery.easing/jquery.easing.min.js"></script>
<script type="text/javascript" src="/status/js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="/status/js/plugins/jquery.jqzoom/jquery.jqzoom.js"></script>
<script type="text/javascript" src="/status/js/plugins/jquery.jqzoom/zoom.js"></script>
</body>
</html>