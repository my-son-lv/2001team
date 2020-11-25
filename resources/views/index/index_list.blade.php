
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>产品列表页</title>
    <link rel="icon" href="assets//status/img/favicon.ico">

    <link rel="stylesheet" type="text/css" href="/status/css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="/status/css/pages-list.css" />
    <link rel="stylesheet" type="text/css" href="/status/css/widget-cartPanelView.css" />
</head>

<body>
<!-- 头部栏位 -->
<!--页面顶部-->
@include("frag.index.index_top")
<!--list-content-->
<div class="main">
    <div class="py-container">
        <!--bread-->
        <div class="bread">
            <ul class="fl sui-breadcrumb">
                <li>
                    <a href="/">全部结果</a>
                </li>
                <li class="active">{{$cate_name->cate_name}}</li>
            </ul>
           
        </div>
        <!--selector-->
        <div class="clearfix selector">
            <div class="type-wrap">
                <div class="fl key">筛选项</div>
                <div class="fl value"></div>
                <div class="fl ext"></div>
            </div>
            <div class="type-wrap logo">
                <div class="fl key brand">品牌</div>
                <div class="value logos">
                    <ul class="logo-list search">
                        <!-- <li><img src="/status/img/_/phone01.png"></li> -->
                    @foreach($brand as $v)
                        <li field="brand_id" value="{{$v->brand_id}}">
                        <a href="javascript:;"  @if(isset($query['brand_id']) && $query['brand_id']==$v->brand_id) class="redhover" @endif><img src="{{env('JUSTME_URL')}}{{$v->brand_logo}}"></a></li>
                    @endforeach
                    </ul>
                </div> 
            </div>
            <div class="type-wrap">  
                <div class="fl key">价格</div>
                <div class="fl value">
                    <ul class="type-list search">
                    @foreach($price as $v)
                        <li field="price" value="{{$v}}">
                        <a href="javascript:;" @if(isset($query['price']) && $query['price']==$v) class="redhover" @endif>{{$v}}</a>
                        </li>
                    @endforeach
                    </ul>
                </div>
                <div class="fl ext">
                </div>
            </div>
            <!-- <div class="type-wrap">
                <div class="fl key">更多筛选项</div>
                <div class="fl value">
                    <ul class="type-list">
                        <li>
                            <a>特点</a>
                        </li>
                        <li>
                            <a>系统</a>
                        </li>
                        <li>
                            <a>手机内存 </a>
                        </li>
                        <li>
                            <a>单卡双卡</a>
                        </li>
                        <li>
                            <a>其他</a>
                        </li>
                    </ul>
                </div>
                <div class="fl ext">
                </div>
            </div> -->
        </div>
        <!--details-->
        <div class="details">
            <div class="sui-navbar">
                <div class="navbar-inner filter">
                    <ul class="sui-nav">
                        <li class="active">
                            <a href="javascript:;">综合</a>
                        </li>
                        <li>
                            <a href="javascript:;">销量</a>
                        </li>
                        <li>
                            <a href="javascript:;">新品</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="goods-list">
                <ul class="yui3-g">
                @foreach($goods as $v)
                    <li class="yui3-u-1-5">
                        <div class="list-wrap">
                            <div class="p-img">
                                <a href="{{url('/index/index_show?goods_id='.$v->goods_id)}}"><img src="{{env('JUSTME_URL')}}{{$v->goods_img}}" /></a>
                            </div>
                            <div class="price">
                                <strong>
                                    <em>¥</em>
                                    <i>{{$v->goods_price}}</i>
                                </strong>
                            </div>
                            <div class="attr">
                                <em>{{$v->goods_name}}</em>
                            </div>
                            <div class="cu">
                                <em><span>促</span>满一件可参加超值换购</em>
                            </div>
                            <div class="commit">
                                <i class="command">已有2000人评价</i>
                            </div>
                            <div class="operate">
                                <a href="success-cart.html" target="_blank" class="sui-btn btn-bordered btn-danger">加入购物车</a>
                                <a href="javascript:void(0);" class="sui-btn btn-bordered">对比</a>
                                <a href="javascript:void(0);" id="colle" value="{{$v->goods_id}}" class="sui-btn btn-bordered">收藏</a>
                                <a href="javascript:void(0);" class="sui-btn btn-bordered">收藏</a>
                                <a href="javascript:void(0);" class="sui-btn btn-bordered">关注</a>
                            </div>
                        </div>
                    </li>
                @endforeach
                </ul>
            </div>
           
            <div class="fr page">
                <div class="sui-pagination pagination-large">
                <ul class="pagination">
                    {{$goods->links()}}
                </ul>
                  
                </div>
            </div>
        </div>
        <!--hotsale-->
        <div class="clearfix hot-sale">
            <h4 class="title">热卖商品</h4>
            <div class="hot-list">
                <ul class="yui3-g">
                @foreach($goods_hot as $v)
                    <li class="yui3-u-1-4">
                        <div class="list-wrap">
                            <div class="p-img">
                                <img src="/status/img/like_01.png" />
                            </div>
                            <div class="attr">
                                <em>{{$v->goods_name}}</em>
                            </div>
                            <div class="price">
                                <strong>
                                    <em>¥</em>
                                    <i>{{$v->goods_price}}</i>
                                </strong>
                            </div>
                            <div class="commit">
                                <i class="command">已有700人评价</i>
                            </div>
                        </div>
                    </li>
                @endforeach 
                </ul>
            </div>
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
                <div onclick="cartPanelView.tabItemClick('cart')" class="toolbar-tab tbar-tab-cart" data="购物车" tag="cart">
                    <i class="tab-ico"></i>
                    <em class="tab-text"></em>
                    <span class="tab-sub J-count " id="tab-sub-cart-count">0</span>
                </div>
                <div onclick="cartPanelView.tabItemClick('follow')" class="toolbar-tab tbar-tab-follow" data="我的关注" tag="follow">
                    <i class="tab-ico"></i>
                    <em class="tab-text"></em>
                    <span class="tab-sub J-count hide">0</span>
                </div>
                <div onclick="cartPanelView.tabItemClick('history')" class="toolbar-tab tbar-tab-history" data="我的足迹" tag="history">
                    <i class="tab-ico"></i>
                    <em class="tab-text"></em>
                    <span class="tab-sub J-count hide">0</span>
                </div>
            </div>

            <div class="toolbar-footer">
                <div class="toolbar-tab tbar-tab-top">
                    <a href="#"> <i class="tab-ico  "></i> <em class="footer-tab-text">顶部</em> </a>
                </div>
                <div class="toolbar-tab tbar-tab-feedback">
                    <a href="#" target="_blank"> <i class="tab-ico"></i> <em class="footer-tab-text ">反馈</em> </a>
                </div>
            </div>

            <div class="toolbar-mini"></div>

        </div>

        <div id="J-toolbar-load-hook"></div>

    </div>
</div>
<!--购物车单元格 模板-->
<script type="text/template" id="tbar-cart-item-template">
    <div class="tbar-cart-item">
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
    $(document).on('click','.search li',function(){
        $(this).siblings().find('a').removeClass('redhover');
        $(this).find('a').addClass('redhover');
        var url = window.location.href;
        // var price_val = $(".price_val").text();
        // alert(price_val);
        var param = '';
        $('.redhover').each(function(i,k){
			var s_val=$(this).parent('li').attr('value');
			var s_key=$(this).parent('li').attr('field');
            // alert(s_val);return; 
             param += s_key+'='+s_val+'&'; 
		});
        // alert(param);
        param = param.substring(0,param.length-1);
        var url=location.protocol + '//' + location.host + location.pathname;
        location.href=url+'?'+param;

       
    })
			
</script>
<script type="text/javascript" src="/status/js/model/cartModel.js"></script>
<script type="text/javascript" src="/status/js/czFunction.js"></script>
<script type="text/javascript" src="/status/js/plugins/jquery.easing/jquery.easing.min.js"></script>
<script type="text/javascript" src="/status/js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="/status/js/widget/cartPanelView.js"></script>
</body>
<script>
    $(document).on("click","#colle",function(){
        var goods_id = $(this).attr("value");
        $.ajax({
            url : "/user_colle",
            data : {goods_id:goods_id},
            dataType : "json",
            type : "post",
            success:function(res){
                if(res.code==0000){
                    alert(res.message)
                }else{
                    alert(res.message)
                }
            }
        })
    })
</script>
</html>