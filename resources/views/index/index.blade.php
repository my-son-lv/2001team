<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
    <title>品优购，优质！优质！</title>
    <link rel="icon" href="assets/status/img/favicon.ico">

    <link rel="stylesheet" type="text/css" href="/status/css/webbase.css"/>
    <link rel="stylesheet" type="text/css" href="/status/css/pages-JD-index.css"/>
    <link rel="stylesheet" type="text/css" href="/status/css/widget-jquery.autocomplete.css"/>
    <link rel="stylesheet" type="text/css" href="/status/css/widget-cartPanelView.css"/>

</head>

<body>
<!-- 头部栏位 -->
<!--页面顶部-->
@include("frag.index.index_top")
        <!--列表-->
<div class="sort">
    <div class="py-container">
        <div class="yui3-g SortList ">
            <div class="yui3-u Left all-sort-list">
                <div class="all-sort-list2">
                    @foreach($cate["info"] as $v)
                        <div class="item bo">
                            <h3><a href="{{url('index/index_list/'.$v['cate_id'])}}">{{$v["cate_name"]}}</a></h3>
                            <div class="item-list clearfix">
                                <div class="subitem">
                                    <dl class="fore1">
                                        @foreach($v["son"] as $vv) 
                                            <dt><a href="{{url('index/index_list/'.$vv['cate_id'])}}">{{$vv["cate_name"]}}</a></dt>
                                        @endforeach
                                        <dd>
                                            @foreach($vv["son"] as $vvv)
                                                <em><a href="{{url('index/index_list/'.$vvv['cate_id'])}}">{{$vvv["cate_name"]}}</a></em>
                                            @endforeach
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="yui3-u Center banerArea">
                <!--banner轮播-->
                <div id="myCarousel" data-ride="carousel" data-interval="4000" class="sui-carousel slide">
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="active item">
                            <a href="http://jd.com/">
                                <img src="/status/img/banner1.jpg"  />
                            </a>
                        </div>
                        <div class="item">
                            <a href="http://baidu.com/">
                                <img src="/status/img/banner2.jpg"  />
                            </a>
                        </div>
                        <div class="item">
                            <a href="http://taobao.com/">
                                <img src="/status/img/banner3.jpg"  />
                            </a>
                        </div>
                    </div><a href="#myCarousel" data-slide="prev" class="carousel-control left">‹</a><a href="#myCarousel" data-slide="next" class="carousel-control right">›</a>
                </div>
            </div>
            <div class="yui3-u Right">
                <div class="news">
                    <h4><em class="fl">快报</em><span class="fr tip"><a href="">更多</a> ></span></h4>
                    <div class="clearix"></div>
                    <ul class="news-list unstyled">
                        @foreach($Butti as $v)
                        <li>
                            <span class="bold">[{{$v->butti_people}}]</span>{{$v->butti_name}}
                        </li>
                            @endforeach
                    </ul>
                    <ul class="yui3-g Lifeservice">
                        <li class="yui3-u-1-4 life-item tab-item">
                            <i class="list-item list-item-1"></i>
                            <span class="service-intro">话费</span>
                        </li>
                        <li class="yui3-u-1-4 life-item tab-item">
                            <i class="list-item list-item-2"></i>
                            <span class="service-intro">机票</span>
                        </li>
                        <li class="yui3-u-1-4 life-item tab-item">
                            <i class="list-item list-item-3"></i>
                            <span class="service-intro">电影票</span>
                        </li>
                        <li class="yui3-u-1-4 life-item tab-item">
                            <i class="list-item list-item-4"></i>
                            <span class="service-intro">游戏</span>
                        </li>
                    </ul>
                </div>
                <div class="life-item-content">
                    <div class="life-detail">
                        <i class="close">关闭</i>
                        <p>话费充值</p>
                        <button class="sui-btn btn-danger invest">去·充值</button>
                    </div>
                    <div class="life-detail">
                        <i class="close">关闭</i>
                        <p>机票预定</p>
                        <button class="sui-btn btn-danger plane">去·预定</button>
                    </div>
                    <div class="life-detail">
                        <i class="close">关闭</i>
                        <p>各式大片等你来看</p>
                        <button class="sui-btn btn-danger film">去·观看</button>
                    </div>
                    <div class="life-detail">
                        <i class="close">关闭</i>
                        <p>在线小游戏等你来战</p>
                        <button class="sui-btn btn-danger game">去·娱乐</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--推荐-->
<div class="show">
    <div class="py-container">
        <ul class="yui3-g Recommend">
            <li class="yui3-u-1-6  clock">
                <div class="time">
                    <img src="/status/img/clock.png" />
                    <h3>今日推荐</h3>
                </div>
            </li>
            @foreach($goods as $v)
            <li class="yui3-u-5-24">           
                <a href="{{url('/index/index_show?goods_id='.$v->goods_id)}}"><img src="{{env('JUST_URL')}}{{$v->goods_img}}" /></a>
                <h4 style="color:red;">{{$v->goods_price}}</h4>
                <p>{{$v->goods_name}}</p>
            </li>
            @endforeach
        </ul>
    </div>
</div>
<!--喜欢-->
<div class="like">
    <div class="py-container">
        <div class="title">
            <h3 class="fl">猜你喜欢</h3>
            <b class="border"></b>
        </div>
        <div class="bd">
            <ul class="clearfix yui3-g Favourate picLB" id="picLBxxl">
                @foreach($cate["data"] as $v)
                    <li class="yui3-u-1-6">
                        <dl class="picDl huozhe">
                            <dd>
                                <a href="{{url('/index/index_show?goods_id='.$v['goods_id'])}}" class="pic"><img src="{{env('JUSTME_URL')}}{{$v['goods_img']}}"   /></a>
                                <div class="like-text">
                                    <p>{{$v["goods_name"]}}</p>
                                    <h3>¥{{$v["goods_price"]}}</h3>
                                </div>
                            </dd>
                            <dd>
                                <a href="" class="pic"><img src="/status/img/like_01.png" alt="" /></a>
                                <div class="like-text">
                                    <p>爱仕达 30CM炒锅不粘锅NWG8330E电磁炉炒</p>
                                    <h3>¥116.00</h3>
                                </div>
                            </dd>
                        </dl>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<!--有趣-->
<div class="fun">
    <div class="py-container">
        <div class="title">
            <h3 class="fl">传智播客.有趣区</h3>
        </div>
        <div class="clearfix yui3-g Interest">
            <span class="x-line"></span>
            <div class="yui3-u row-405 Interest-conver">
                @include("advert.1_1")
            </div>
            <div class="yui3-u row-225 Interest-conver-split">
                <h5>好东西</h5>
                @include("advert.2_1")
                @include("advert.3_1")
            </div>
            <div class="yui3-u row-405 Interest-conver-split blockgary">
                <h5>品牌街</h5>
                <div class="split-bt">
                    @include("advert.4_1")
                </div>
                <div class="x-img fl">
                    @include("advert.5_1")
                </div>
                <div class="x-img fr">
                    @include("advert.6_1")
                </div>
            </div>
            <div class="yui3-u row-165 brandArea">
                <span class="brand-yline"></span>
                <ul class="yui3-g brand-list">
                    @include("advert.7_1")
                    @include("advert.8_1")
                    @include("advert.9_1")
                    @include("advert.10_1")
                </ul>
            </div>
        </div>
    </div>
</div>
<!--楼层-->
<div id="floor-1" class="floor">
    <div class="py-container">
        <div class="title floors">
            <div class="fr">
                <ul class="sui-nav nav-tabs">
                    @foreach($cate["cate"] as $v)
                    <li class="active">
                        <a href="#tab1" data-toggle="tab">{{$v["cate_name"]}}</a>
                    </li>
                        @endforeach
                </ul>
            </div>
        </div>
        <div class="clearfix  tab-content floor-content">
            <div id="tab1" class="tab-pane active">
                <div class="yui3-g Floor-1">
                    <div class="yui3-u Left blockgary">
                        <ul class="jd-list">
                            @foreach($cate["cate"] as $v)
                                <li class="active">
                                    {{$v["cate_name"]}}
                                </li>
                            @endforeach
                        </ul>
                        @include("advert.11_1")
                    </div>
                    <div class="yui3-u row-330 floorBanner">
                        <div id="floorCarousel" data-ride="carousel" data-interval="4000" class="sui-carousel slide">
                            <ol class="carousel-indicators">
                                <li data-target="#floorCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#floorCarousel" data-slide-to="1"></li>
                                <li data-target="#floorCarousel" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="active item">
                                    @include("advert.12_1")
                                </div>
                            </div>
                            <a href="#floorCarousel" data-slide="prev" class="carousel-control left">‹</a>
                            <a href="#floorCarousel" data-slide="next" class="carousel-control right">›</a>
                        </div>
                    </div>
                    <div class="yui3-u row-220 split">
                        <span class="floor-x-line"></span>
                        <div class="floor-conver-pit">
                            @include("advert.13_1")
                        </div>
                        <div class="floor-conver-pit">
                            @include("advert.13_1")
                        </div>
                    </div>
                    <div class="yui3-u row-218 split">
                        @include("advert.15_1")
                    </div>
                    <div class="yui3-u row-220 split">
                        <span class="floor-x-line"></span>
                        <div class="floor-conver-pit">
                            @include("advert.16_1")
                        </div>
                        <div class="floor-conver-pit">
                            @include("advert.17_1")
                        </div>
                    </div>
                </div>
            </div>
            <div id="tab2" class="tab-pane">
                <p>第二个</p>
            </div>
            <div id="tab3" class="tab-pane">
                <p>第三个</p>
            </div>
            <div id="tab4" class="tab-pane">
                <p>第4个</p>
            </div>
            <div id="tab5" class="tab-pane">
                <p>第5个</p>
            </div>
            <div id="tab6" class="tab-pane">
                <p>第6个</p>
            </div>
            <div id="tab7" class="tab-pane">
                <p>第7个</p>
            </div>
        </div>
    </div>
</div>
<div id="floor-2" class="floor">
    <div class="py-container">
        <div class="title floors">
            <div class="fr">
                <ul class="sui-nav nav-tabs">
                    @foreach($cate["cate"] as $v)
                        <li class="active">
                            <a href="#tab1" data-toggle="tab">{{$v["cate_name"]}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="clearfix  tab-content floor-content">
            <div id="tab8" class="tab-pane active">
                <div class="yui3-g Floor-1">
                    <div class="yui3-u Left blockgary">
                        <ul class="jd-list">
                            @foreach($cate["cate"] as $v)
                            <li>{{$v["cate_name"]}}</li>
                                @endforeach
                        </ul>
                        @include("advert.11_1")
                    </div>
                    <div class="yui3-u row-330 floorBanner">
                        <div id="floorCarousell" data-ride="carousel" data-interval="4000" class="sui-carousel slide">
                            <ol class="carousel-indicators">
                                <li data-target="#floorCarousell" data-slide-to="0" class="active"></li>
                                <li data-target="#floorCarousell" data-slide-to="1"></li>
                                <li data-target="#floorCarousell" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="active item">
                                    @include("advert.12_1")
                                </div>
                            </div>
                            <a href="#floorCarousell" data-slide="prev" class="carousel-control left">‹</a>
                            <a href="#floorCarousell" data-slide="next" class="carousel-control right">›</a>
                        </div>
                    </div>
                    <div class="yui3-u row-220 split">
                        <span class="floor-x-line"></span>
                        <div class="floor-conver-pit">
                            @include("advert.13_1")
                        </div>
                        <div class="floor-conver-pit">
                            @include("advert.14_1")
                        </div>
                    </div>
                    <div class="yui3-u row-218 split">
                        @include("advert.15_1")
                    </div>
                    <div class="yui3-u row-220 split">
                        <span class="floor-x-line"></span>
                        <div class="floor-conver-pit">
                            @include("advert.16_1")
                        </div>
                        <div class="floor-conver-pit">
                            @include("advert.17_1")
                        </div>
                    </div>
                </div>
            </div>
            <div id="tab2" class="tab-pane">
                <p>第二个</p>
            </div>
            <div id="tab9" class="tab-pane">
                <p>第三个</p>
            </div>
            <div id="tab10" class="tab-pane">
                <p>第4个</p>
            </div>
            <div id="tab11" class="tab-pane">
                <p>第5个</p>
            </div>
            <div id="tab12" class="tab-pane">
                <p>第6个</p>
            </div>
            <div id="tab13" class="tab-pane">
                <p>第7个</p>
            </div>
            <div id="tab14" class="tab-pane">
                <p>第8个</p>
            </div>
        </div>
    </div>
</div>
<!--商标-->
<div class="brand">
    <div class="py-container">
        <ul class="Brand-list blockgary">
            @foreach($brand as $v)
            <li class="Brand-item" title="{{$v->brand_name}}"><img src="{{env('JUSTME_URL')}}{{$v->brand_logo}}"/></li>
            @endforeach
        </ul>
    </div>
</div>
<!-- 底部栏位 -->
<!--页面底部-->
@include("frag.index.index_foot")
        <!--页面底部END-->
<!--侧栏面板开始-->
<div class="J-global-toolbar">
    <div class="toolbar-wrap J-wrap">
        <div class="toolbar">
            <div class="toolbar-panels J-panel">

                <!-- 购物车 -->
                <div style="visibility: hidden;" class="J-content toolbar-panel tbar-panel-cart toolbar-animate-out">
                    <h3 class="tbar-panel-header J-panel-header">
                        <a href="" class="title"><i></i><em class="title">购物车</em></a>
                        <span class="close-panel J-close" onclick="cartPanelView.tbar_panel_close('cart');" ></span>
                    </h3>
                    <div class="tbar-panel-main">
                        <div class="tbar-panel-content J-panel-content">
                            <div id="J-cart-tips" class="tbar-tipbox hide">
                                <div class="tip-inner">
                                    <span class="tip-text">还没有登录，登录后商品将被保存</span>
                                    <a href="#none" class="tip-btn J-login">登录</a>
                                </div>
                            </div>
                            <div id="J-cart-render">
                                <!-- 列表 -->
                                <div id="cart-list" class="tbar-cart-list">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 小计 -->
                    <div id="cart-footer" class="tbar-panel-footer J-panel-footer">
                        <div class="tbar-checkout">
                            <div class="jtc-number"> <strong class="J-count" id="cart-number">0</strong>件商品 </div>
                            <div class="jtc-sum"> 共计：<strong class="J-total" id="cart-sum">¥0</strong> </div>
                            <a class="jtc-btn J-btn" href="#none" target="_blank">去购物车结算</a>
                        </div>
                    </div>
                </div>

                <!-- 我的关注 -->
                <div style="visibility: hidden;" data-name="follow" class="J-content toolbar-panel tbar-panel-follow">
                    <h3 class="tbar-panel-header J-panel-header">
                        <a href="#" target="_blank" class="title"> <i></i> <em class="title">我的关注</em> </a>
                        <span class="close-panel J-close" onclick="cartPanelView.tbar_panel_close('follow');"></span>
                    </h3>
                    <div class="tbar-panel-main">
                        <div class="tbar-panel-content J-panel-content">
                            <div class="tbar-tipbox2">
                                <div class="tip-inner"> <i class="i-loading"></i> </div>
                            </div>
                        </div>
                    </div>
                    <div class="tbar-panel-footer J-panel-footer"></div>
                </div>

                <!-- 我的足迹 -->
                <div style="visibility: hidden;" class="J-content toolbar-panel tbar-panel-history toolbar-animate-in">
                    <h3 class="tbar-panel-header J-panel-header">
                        <a href="#" target="_blank" class="title"> <i></i> <em class="title">我的足迹</em> </a>
                        <span class="close-panel J-close" onclick="cartPanelView.tbar_panel_close('history');"></span>
                    </h3>
                    <div class="tbar-panel-main">
                        <div class="tbar-panel-content J-panel-content">
                            <div class="jt-history-wrap">
                                <ul>
                                    <!--<li class="jth-item">
                                        <a href="#" class="img-wrap"> <img src=".portal//status/img/like_03.png" height="100" width="100" /> </a>
                                        <a class="add-cart-button" href="#" target="_blank">加入购物车</a>
                                        <a href="#" target="_blank" class="price">￥498.00</a>
                                    </li>
                                    <li class="jth-item">
                                        <a href="#" class="img-wrap"> <img src="portal//status/img/like_02.png" height="100" width="100" /></a>
                                        <a class="add-cart-button" href="#" target="_blank">加入购物车</a>
                                        <a href="#" target="_blank" class="price">￥498.00</a>
                                    </li>-->
                                </ul>
                                <a href="#" class="history-bottom-more" target="_blank">查看更多足迹商品 &gt;&gt;</a>
                            </div>
                        </div>
                    </div>
                    <div class="tbar-panel-footer J-panel-footer"></div>
                </div>

            </div>

            <div class="toolbar-header"></div>

            <!-- 侧栏按钮 -->
            <div class="toolbar-tabs J-tab">
                <div onclick="cartPanelView.tabItemClick('cart')" class="toolbar-tab tbar-tab-cart" data="购物车" tag="cart" >
                    <i class="tab-ico"></i>
                    <em class="tab-text"></em>
                    <span class="tab-sub J-count " id="tab-sub-cart-count">0</span>
                </div>
                <div onclick="cartPanelView.tabItemClick('follow')" class="toolbar-tab tbar-tab-follow" data="我的关注" tag="follow" >
                    <i class="tab-ico"></i>
                    <em class="tab-text"></em>
                    <span class="tab-sub J-count hide">0</span>
                </div>
                <div onclick="cartPanelView.tabItemClick('history')" class="toolbar-tab tbar-tab-history" data="我的足迹" tag="history" >
                    <i class="tab-ico"></i>
                    <em class="tab-text"></em>
                    <span class="tab-sub J-count hide">0</span>
                </div>
            </div>

            <div class="toolbar-footer">
                <div class="toolbar-tab tbar-tab-top" > <a href="#"> <i class="tab-ico  "></i> <em class="footer-tab-text">顶部</em> </a> </div>
                <div class="toolbar-tab tbar-tab-feedback" > <a href="#" target="_blank"> <i class="tab-ico"></i> <em class="footer-tab-text ">反馈</em> </a> </div>
            </div>

            <div class="toolbar-mini"></div>

        </div>

        <div id="J-toolbar-load-hook"></div>

    </div>
</div>
<!--购物车单元格 模板-->
<script type="text/template" id="tbar-cart-item-template">
    <div class="tbar-cart-item" >
        <div class="jtc-item-promo">
            <em class="promo-tag promo-mz">满赠<i class="arrow"></i></em>
            <div class="promo-text">已购满600元，您可领赠品</div>
        </div>
        <div class="jtc-item-goods">
            <span class="p-img"><a href="#" target="_blank"><img src="{2}" alt="{1}" height="50" width="50" /></a></span>
            <div class="p-name">
                <a href="#">{1}</a>
            </div>
            <div class="p-price"><strong>¥{3}</strong>×{4} </div>
            <a href="#none" class="p-del J-del">删除</a>
        </div>
    </div>
</script>
<!--侧栏面板结束-->
<!-- <script type="text/javascript" src="/status/js/plugins/jquery/jquery.min.js"></script> -->
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
<script type="text/javascript" src="/status/js/czFunction.js"></script>
<script type="text/javascript" src="/status/js/plugins/jquery.easing/jquery.easing.min.js"></script>
<script type="text/javascript" src="/status/js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="/status/js/pages/index.js"></script>
<script type="text/javascript" src="/status/js/widget/cartPanelView.js"></script>
<script type="text/javascript" src="/status/js/widget/jquery.autocomplete.js"></script>
<script type="text/javascript" src="/status/js/widget/nav.js"></script>
</body>


</html>
<script>
    $(document).on('click','.invest',function(){
        location.href="https://re.jd.com/search?keyword=%e5%85%85%20%e8%af%9d%e8%b4%b9&keywordid=69864031620&re_dcp=202m0QjIIg==&traffic_source=1004&test=1&enc=utf8&cu=true&utm_source=baidu-search&utm_medium=cpc&utm_campaign=t_262767352_baidusearch&utm_term=69864031620_0_5547bf3c1fbb428abff36dbe83c273ff";
    })
    $(document).on('click','.plane',function(){
        location.href="http://www.xinya188.com/";
    })
    $(document).on('click','.film',function(){
        location.href="https://maoyan.com/";
    })
    $(document).on('click','.game',function(){
        location.href="http://www.4399.com/";
    })
    $(document).on('click','.kbmore',function(){
        location.href="https://www.jiemian.com/lists/84.html";
    })
</script>