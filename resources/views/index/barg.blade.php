<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>品优购秒杀-正品秒杀！</title>
    <link rel="icon" href="/assets//status/img/favicon.ico">
    <link rel="stylesheet" type="text/css" href="/status/css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="/status/css/widget-jquery.autocomplete.css" />
    <link rel="stylesheet" type="text/css" href="/status/css/pages-seckill-index.css" />
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
<script type="text/javascript" src="/status/js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="/status/js/widget/jquery.autocomplete.js"></script>
<script type="text/javascript" src="/status/js/widget/nav.js"></script>
<script type="text/javascript" src="/status/js/pages/seckill-index.js"></script>
<script>
    $(function(){
        $("#code").hover(function(){
            $(".erweima").show();
        },function(){
            $(".erweima").hide();
        });
    })
</script>
</body>

<div class="py-container index">
    <!--banner-->
    <div class="banner">
        <img src="/xcgsy/1606974541(1).jpg" class="img-responsive" alt="">
    </div>
    <HR style="FILTER: progid:DXImageTransform.Microsoft.Glow(color=#987cb9,strength=10)" width="80%" color=#987cb9 SIZE=1>
    <!--商品列表-->
    <div class="goods-list">
        <ul class="seckill" id="seckill">
            @foreach($data as $v)
                <li class="seckill-item">
                    <div class="pic">
                        <a href="{{url('/index/brag_show?barg_id='.$v->barg_id)}}"><img src="{{env('JUSTME_URL')}}{{$v["goods_img"]}}" alt=''></a>
                    </div>
                    <div class="intro"><span>{{$v["goods_name"]}}</span></div>
                    <div class='price'><b class='ever-price'>￥{{$v["present_price"]}}</b></div>
                    <div class='num'>
                        <div>已售87%</div>
                        <div class='progress'>
                            <div class='sui-progress progress-danger'>
                            <span style='width: 70%;' class='bar'>

                            </span>
                            </div>
                        </div>
                        <div>剩余<b class='owned'>{{$v["cut_number"]}}</b>件</div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="cd-top">
        <div class="top">
            <img src="/status/img/_/gotop.png" />
            <b>TOP</b>
        </div>
        <div class="code" id="code">
            <span><img src="/status/img/_/code.png"/></span>
        </div>
        <div class="erweima">
            <img src="/status/img/_/erweima.jpg" alt="">
            <s></s>
        </div>
    </div>
</div>
<!--回到顶部-->

<!-- 底部栏位 -->
<!--页面底部-->
@include("frag.index.index_foot")
        <!--页面底部END-->
</html>