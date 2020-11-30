<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>产品详情页</title>
    <link rel="icon" href="assets//status/img/favicon.ico">

    <link rel="stylesheet" type="text/css" href="/status/css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="/status/css/pages-item.css" />
    <link rel="stylesheet" type="text/css" href="/status/css/pages-zoom.css" />
    <link rel="stylesheet" type="text/css" href="/status/css/widget-cartPanelView.css" />
</head>

<body>
<!-- 头部栏位 -->
<!--页面顶部-->
@include("frag.index.index_top")
<div class="py-container">
    <div id="item">
        <div class="crumb-wrap">
            <ul class="sui-breadcrumb">
                <li>
                    <a href="#">手机、数码、通讯</a>
                </li>
                <li>
                    <a href="#">手机</a>
                </li>
                <li>
                    <a href="#">Apple苹果</a>
                </li>
                <li class="active">iphone 6S系类</li>
            </ul>
        </div>
        <!--product-info-->
        <div class="product-info">
            <div class="fl preview-wrap">
                <!--放大镜效果-->
                <div class="zoom">
                    <!--默认第一个预览-->
                    <div id="preview" class="spec-preview">
                        <span class="jqzoom">
                                <img src="{{env('JUSTME_URL')}}{{$cate['goods']["goods_img"]}}" width="405px" height="395px"/>
                        </span>
                    </div>
                    <!--下方的缩略图-->
                    <div class="spec-scroll">
                        <a class="prev">&lt;</a>
                        <!--左右按钮-->
                        <div class="items">
                            <ul>
                                @if($cate['goodsimg'])
                                @foreach($cate['goodsimg'] as $v)
                                <li>
                                    <img src="{{env('JUSTME_URL')}}{{$cate['goodsimg'][0]['goods_imgs']}}" bimg="{{env('JUSTME_URL')}}{{$cate['goodsimg'][0]['goods_imgs']}}"  width="100px" height="100px"  onmousemove="preview(this)" />
                                </li>
                                @endforeach
                                    @endif
                            </ul>
                        </div>
                        <a class="next">&gt;</a>
                    </div>
                </div>
            </div>
            <div class="fr itemInfo-wrap">
                <div class="sku-name">
                    <h4>{{$cate['goods']['goods_name']}}</h4>
                </div>
                <div class="news"><span>推荐选择下方[移动优惠购],手机套餐齐搞定,不用换号,每月还有花费返</span></div>
                <div class="summary">
                    <div class="summary-wrap">
                        <div class="fl title">
                            <i>价　　格</i>
                        </div>
                        <div class="fl price">
                            <i>¥</i>
                            <em>{{$cate['goods']['goods_price']}}</em>
                            <span>降价通知</span>
                        </div>
                        <div class="fr remark">
                            <i>累计评价</i><em>612188</em>
                        </div>
                    </div>
                    <div class="summary-wrap">
                        <div class="fl title">
                            <i>促　　销</i>
                        </div>
                        <div class="fl fix-width">
                            <i class="red-bg">加价购</i>
                            <em class="t-gray">满999.00另加20.00元，或满1999.00另加30.00元，或满2999.00另加40.00元，即可在购物车换
                                购热销商品</em>
                        </div>
                    </div>
                </div>
                <div class="support">
                    <div class="summary-wrap">
                        <div class="fl title">
                            <i>支　　持</i>
                        </div>
                        <div class="fl fix-width">
                            <em class="t-gray">以旧换新，闲置手机回收  4G套餐超值抢  礼品购</em>
                        </div>
                    </div>
                    <div class="summary-wrap">
                        <div class="fl title">
                            <i>配 送 至</i>
                        </div>
                        <div class="fl fix-width">
                            <em class="t-gray">满999.00另加20.00元，或满1999.00另加30.00元，或满2999.00另加40.00元，即可在购物车换购热销商品</em>
                        </div>
                    </div>
                </div>
                <div class="clearfix choose">
                    <div id="specification" class="summary-wrap clearfix">
                        @foreach($cate["newdata"] as $k=>$v)
                        <dl>
                            <dt>
                            <div class="fl title">
                                <i>{{$v['specs_name']}}</i>
                            </div>
                            </dt>
                            @php $i=0; @endphp
                            @foreach($v['specs'] as  $kk=>$vv)
                                <dd><a href="javascript:;"  @if($i==0) class="selected" @endif sepcs_id="{{$k}}" goods_attr_id="{{$kk}}" >{{$vv}}<span title="点击取消选择">&nbsp;</span>
                                    </a></dd>
                                    @php $i++; @endphp
                            @endforeach
                        </dl>
                        @endforeach
                    </div>
                        <div class="fl title">
                            <div class="control-group">
                                <div class="controls">
                                    <input autocomplete="off" type="text" value="1" minnum="1" class="itxt" />
                                    <a href="javascript:void(0)" class="increment plus">+</a>
                                    <a href="javascript:void(0)" class="increment mins">-</a>
                                </div>
                            </div>
                        </div>
                        <div class="fl">
                            <ul class="btn-choose unstyled">
                                <li>
                                    <a href="javascript:void(0);"  class="sui-btn  btn-danger addshopcar">加入购物车</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--product-detail-->
        <div class="clearfix product-detail">
            <div class="fl aside">
                <ul class="sui-nav nav-tabs tab-wraped">
                    <li class="active">
                        <a href="#index" data-toggle="tab">
                            <span>相关分类</span>
                        </a>
                    </li>
                    <li>
                        <a href="#profile" data-toggle="tab">
                            <span>推荐品牌</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content tab-wraped">
                    <div id="index" class="tab-pane active">
                       
                        <ul class="goods-list unstyled">
                        @foreach($cateinfo as $v)
                            <li>
                                <div class="list-wrap">
                                    <div class="p-img">
                                        <a href="{{url('/index/index_show?goods_id='.$v['goods_id'])}}"><img src="{{env('JUSTME_URL')}}{{$v->goods_img}}" width="150px"/></a>
                                    </div>
                                    <div class="attr">
                                        <em>{{$v->goods_name}}</em>
                                    </div>
                                    <div class="price">
                                        <strong>
                                            <em>¥</em>
                                            <i>6088.00</i>
                                        </strong>
                                    </div>
                                    <div class="operate">
                                        <a href="javascript:void(0);" class="sui-btn btn-bordered">加入购物车</a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                    <div id="profile" class="tab-pane">
                        <p>推荐品牌</p>
                    </div>
                </div>
            </div>
            <div class="fr detail">

                <div class="clearfix fitting">
                    <h4 class="kt">选择搭配</h4>
                    <div class="good-suits">
                    @foreach($hot as $v)
                        <div class="fl master">
                       
                            <div class="list-wrap">
                                <div class="p-img">
                                <a href="{{url('/index/index_show?goods_id='.$v['goods_id'])}}" class="pic"><img src="{{env('JUSTME_URL')}}{{$v['goods_img']}}" width="150px" /></a>
                                </div>
                                <p>{{$v->goods_name}}</p>
                                <em>￥5299</em>
                            </div>
                       
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-main intro">
                    <ul class="sui-nav nav-tabs tab-wraped">
                        <li class="active">
                            <a href="#one" data-toggle="tab">
                                <span>商品介绍</span>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                    <div class="tab-content tab-wraped">
                        <div id="one" class="tab-pane active">
                            <ul class="goods-intro unstyled">
                                <li>{{$cate['goods']['goods_name']}}</li>
                            </ul>
                            <div class="intro-detail">
                                <img src="{{env("JUSTME_URL")}}{{$cate['goods']['goods_img']}}" />
                                <img src="{{env('JUSTME_URL')}}{{$cate['goodsimg'][0]['goods_imgs']}}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--like-->
        <div class="clearfix"></div>
        <div class="like">
            <h4 class="kt">猜你喜欢</h4>
            <div class="like-list">
                <ul class="yui3-g">
                @foreach($home["data"] as $v)
                    <li class="yui3-u-1-6">
                        <div class="list-wrap">
                            <div class="p-img">
                            <a href="{{url('/index/index_show?goods_id='.$v['goods_id'])}}" class="pic"><img src="{{env('JUSTME_URL')}}{{$v['goods_img']}}"   /></a>
                            </div>
                            <div class="attr">
                                <em>{{$v["goods_name"]}}</em>
                            </div>
                            <div class="price">
                                <strong>
                                    <em>¥</em>
                                    <i>{{$v["goods_price"]}}</i>
                                </strong>
                            </div>
                            <div class="commit">
                                <i class="command">已有6人评价</i>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
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
        $('dd a').click(function(){
            $(this).parent().siblings().find('a').removeClass("selected");
            $(this).addClass("selected");
//            getgoodsprice();
        });
        //加入购物车
        $(document).on("click",".addshopcar",function(){
            var goods_id = "{{$cate['goods']['goods_id']}}";
            var goods_number = $('.itxt').val();
            var goods_attr_id = new Array();
            $('.selected').each(function(){
                goods_attr_id+=$(this).attr('sepcs_id')+','+$(this).attr('goods_attr_id')+':';
            });
            goods_attr_id = goods_attr_id.substr(0,goods_attr_id.length-1);
            $.ajax({
                url:"/index/addcart",
                data:{goods_id:goods_id,goods_number:goods_number,goods_attr_id:goods_attr_id},
                type:"post",
                dataType:"json",
                success:function(res){
                    if(res.code=='0000'){
                        alert(res.msg);
                        window.location.href=res.url;
                    }else{
                        alert(res.msg);
                    }
                }
            })
        })



    })
</script>
<script type="text/javascript" src="/status/js/model/cartModel.js"></script>
<script type="text/javascript" src="/status/js/plugins/jquery.easing/jquery.easing.min.js"></script>
<script type="text/javascript" src="/status/js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="/status/js/plugins/jquery.jqzoom/jquery.jqzoom.js"></script>
<script type="text/javascript" src="/status/js/plugins/jquery.jqzoom/zoom.js"></script>
<script type="text/javascript" src="index/index.js"></script>
</body>

</html>