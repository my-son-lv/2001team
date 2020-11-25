
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>我的订单</title>
    <link rel="icon" href="assets//status/img/favicon.ico">

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
</body>
<!--header-->
<div id="account">
    <div class="py-container">
        <div class="yui3-g home">
            <!--左侧列表-->
            @include("frag.index.home_left")
            <!--右侧主内容-->
            <div class="yui3-u-5-6 order-pay">
                <div class="body">
                    <div class="table-title">
                        <table class="sui-table  order-table">
                            <tr>
                                <thead>
                                <th width="35%">宝贝</th>
                                <th width="5%">单价</th>
                                <th width="5%">数量</th>
                                <th width="8%">商品操作</th>
                                <th width="10%">实付款</th>
                                <th width="10%">交易状态</th>
                                <th width="10%">交易操作</th>
                                </thead>
                            </tr>
                        </table>
                    </div>
                    <div class="order-detail">
                        <div class="orders">
                            <!--order1-->
                            @if(!count($data))
                                <center><b><h1>暂无订单</h1></b></center>
                                @else
                            @foreach($data as $v)
                            <div class="choose-title">
                                <label data-toggle="checkbox" class="checkbox-pretty ">
                                    <input type="checkbox" checked="checked"><span>2017-02-11 11:59　订单编号：7867473872181848  店铺：哇哈哈 <a>和我联系</a></span>
                                </label>
                                <a class="sui-btn btn-info share-btn">分享</a>
                            </div>
                            <table class="sui-table table-bordered order-datatable">
                                <tbody>
                                <tr>
                                    <td width="35%">
                                        <div class="typographic"><img src="/status/img/goods.png" />
                                            <a href="#" class="block-text">{{$v->goods_name}}</a>
                                        </div>
                                    </td>
                                    <td width="5%" class="center">
                                        <ul class="unstyled">
                                            <li>¥{{$v->goods_price}}.00</li>
                                        </ul>
                                    </td>
                                    <td width="5%" class="center">{{$v->buy_number}}</td>
                                    <td width="8%" class="center">
                                    </td>
                                    <td width="10%" class="center" >
                                        <ul class="unstyled">
                                            <li>¥{{$v->order_price}}.00</li>
                                        </ul>
                                    </td>
                                    <td width="10%" class="center">
                                        <ul class="unstyled">
                                            <li>
                                                @if($v->pay_status==1)
                                                    待支付
                                                    @elseif($v->pay_status==2)
                                                    已支付
                                                    @elseif($v->order_status==0)
                                                    未确认
                                                    @elseif($v->order_status==1)
                                                    确认
                                                    @elseif($v->order_status==2)
                                                    已取消
                                                    @elseif($v->order_status==3)
                                                    无效
                                                    @elseif($v->order_status==4)
                                                    退货
                                                    @elseif($v->shipping_status==0)
                                                    未发货
                                                    @elseif($v->shipping_status==1)
                                                    已发货
                                                    @elseif($v->shipping_status==2)
                                                    已收货
                                                    @elseif($v->shipping_status==4)
                                                    退货
                                                    @endif
                                            </li>
                                        </ul>
                                    </td>
                                    <td width="10%" class="center">
                                        @if($v->pay_status==1)
                                        <ul class="unstyled">
                                            <li><a href="#" class="sui-btn btn-info">立即付款</a></li>
                                            <li>取消订单</li>
                                        </ul>
                                            @else
                                            <a href="#" class="sui-btn btn-info">取消订单</a>
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                                @endforeach
                                @endif
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="like-title">
                        <div class="mt">
                            <span class="fl"><strong>热卖单品</strong></span>
                        </div>
                    </div>
                    <div class="like-list">
                        <ul class="yui3-g">
                            @foreach($goods as $v)
                            <li class="yui3-u-1-4">
                                <div class="list-wrap">
                                    <div class="p-img">
                                        <img src="{{env('JUSTME_URL')}}{{$v->goods_img}}" />
                                    </div>
                                    <div class="attr">
                                        <em>{{$v->goods_name}}</em>
                                    </div>
                                    <div class="price">
                                        <strong>
                                            <em>¥</em>
                                            <i>{{$v->goods_price}}.00</i>
                                        </strong>
                                    </div>
                                </div>
                            </li>
                                @endforeach
                        </ul>
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
</html>