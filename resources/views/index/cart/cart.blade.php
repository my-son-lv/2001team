
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>我的购物车</title>

    <link rel="stylesheet" type="text/css" href="/status/css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="/status/css/pages-cart.css" />
</head>

<body>
<!--head-->
<div class="top">
    <div class="py-container">
        <div class="shortcut">
        <ul class="fl">
                        @php  
                            if(isset($_COOKIE['token'])){
                                $cookie=$_COOKIE['token'];
                            }else{
                                $cookie='';
                            }
                            if(isset($_COOKIE['user_name'])){
                                $user_name=$_COOKIE['user_name'];
                            }else{
                                $user_name='';
                            }
                        @endphp
                        @if($cookie)
                            <li class="f-item">欢迎<a href="javascript:;" style="color:red;">&nbsp;{{$user_name}}&nbsp;</a>登录</li>
                            <li class="f-item"><a href="/loginout">&nbsp;&nbsp;退出登录</a></li>
                        @else
                            <li class="f-item">品优购欢迎您！</li>
                            <li class="f-item">请<a href="/login">登录</a>
                            <span><a href="/reg">免费注册</a></span></li>
                        @endif
                    </ul>
            <ul class="fr">
                <li class="f-item">我的订单</li>
                <li class="f-item space"></li>
                <li class="f-item">我的品优购</li>
                <li class="f-item space"></li>
                <li class="f-item">品优购会员</li>
                <li class="f-item space"></li>
                <li class="f-item">企业采购</li>
                <li class="f-item space"></li>
                <li class="f-item">关注品优购</li>
                <li class="f-item space"></li>
                <li class="f-item">客户服务</li>
                <li class="f-item space"></li>
                <li class="f-item">网站导航</li>
            </ul>
        </div>
    </div>
</div>
<div class="cart py-container">
    <!--logoArea-->
    <div class="logoArea">
        <div class="fl logo"><span class="title">购物车</span></div>
        <div class="fr search">
            <form class="sui-form form-inline">
                <div class="input-append">
                    <input type="text" type="text" class="input-error input-xxlarge" placeholder="品优购自营" />
                    <button class="sui-btn btn-xlarge btn-danger" type="button">搜索</button>
                </div>
            </form>
        </div>
    </div>
    <!--All goods-->
    <div class="allgoods">
        <h4>全部商品<span>11</span></h4>
        <div class="cart-main">
            <div class="yui3-g cart-th">
                <div class="yui3-u-1-4"><input type="checkbox" name="" id="" value="" /> 全部</div>
                <div class="yui3-u-1-4">商品</div>
                <div class="yui3-u-1-8">单价（元）</div>
                <div class="yui3-u-1-8">数量</div>
                <div class="yui3-u-1-8">小计（元）</div>
                <div class="yui3-u-1-8">操作</div>
            </div>
            <div class="cart-item-list">
                <div class="cart-shop">
                    <input type="checkbox" name="" id="" value="" />
                    <span class="shopname">神州数码专营店</span>
                </div>
                <div class="cart-body">
                    <div class="cart-list">
                        @foreach($cart as $v)
                            {{--@php  dump($cart)  @endphp--}}
                        <ul class="goods-list yui3-g">
                            <li class="yui3-u-1-24">
                                <input type="checkbox"  class="cart_id" value="{{$v['cart_id']}}" />
                            </li>
                            <li class="yui3-u-11-24">
                                <div class="good-item">
                                    <div class="item-img"><img src="{{env('JUSTME_URL')}}{{$v['goods_img']}}" /></div>
                                    <div class="item-msg">{{$v['goods_name']}}
                                        <br>
                                        @foreach($v['specs'] as $vv)
                                            {{$vv['specs_name']}}:{{$vv['specs_val']}}
                                            @endforeach
                                    </div>
                                </div>
                            </li>

                            <li class="yui3-u-1-8"><span class="price">￥{{$v['goods_price']}}</span></li>
                            <li class="yui3-u-1-8">
                                <a href="javascript:void(0)" class="increment mins" cart_id="{{$v['cart_id']}}">-</a>
                                <input autocomplete="off" type="text" cart_id="{{$v['cart_id']}}" value="{{$v['buy_number']}}" minnum="1" class="itxt" />
                                <a href="javascript:void(0)" class="increment plus" cart_id="{{$v['cart_id']}}">+</a>
                            </li>
                            <li class="yui3-u-1-8"><span class="sum">{{$v['goods_price']*$v['buy_number']}}</span></li>
                            <li class="yui3-u-1-8">
                                <a href="javascript:void(0)" cart_id="{{$v['cart_id']}}" id="del">删除</a><br />
                                <a href="#none">移到我的关注</a>
                            </li>
                        </ul>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="cart-tool">
            <div class="select-all">
                <input type="checkbox" name="" id="" value="" class="checkbox" />
                <span>全选</span>
            </div>
            <div class="option">
                <a href="#none">删除选中的商品</a>
                <a href="#none">移到我的关注</a>
                <a href="#none">清除下柜商品</a>
            </div>
            <div class="toolbar">
                <div class="chosed">已选择<span>0</span>件商品</div>
                <div class="sumprice">
                    <span><em>总价（不含运费） ：</em><i class="summoney">¥0</i></span>
                    <span><em>已节省：</em><i>-¥20.00</i></span>
                </div>
                <div class="sumbtn">
                    <a class="sum-btn" href="javascript:void(0)" >结算</a>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="liked">
            <ul class="sui-nav nav-tabs">
                <li class="active">
                    <a href="#index" data-toggle="tab">猜你喜欢</a>
                </li>
            </ul>
            <div class="clearfix"></div>
            <div class="tab-content">
                <div id="index" class="tab-pane active">
                    <div id="myCarousel" data-ride="carousel" data-interval="4000" class="sui-carousel slide">
                        <div class="carousel-inner">
                            <div class="active item">
                                <ul>
                                    @foreach($goods as $v)

                                    <li>
                                        <a href="{{url('/index/index_show?goods_id='.$v['goods_id'])}}"><img src="{{env("JUSTME_URL")}}{{$v['goods_img']}}" width="200px" height="200px" /></a>
                                        <div class="intro">
                                            <i>{{$v['goods_name']}}</i>
                                        </div>
                                        <div class="money">
                                            <span>${{$v['goods_price']}}</span>
                                        </div>
                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                        <a href="#myCarousel" data-slide="prev" class="carousel-control left">‹</a>
                        <a href="#myCarousel" data-slide="next" class="carousel-control right">›</a>
                    </div>
                </div>
                <div id="profile" class="tab-pane">
                    <p>特惠选购</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 底部栏位 -->
<!--页面底部-->
@include("frag.index.index_foot")
<!--页面底部END-->
<script type="text/javascript" src="/status/js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="/status/js/plugins/jquery.easing/jquery.easing.min.js"></script>
<script type="text/javascript" src="/status/js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="/status/js/widget/nav.js"></script>
</body>
<script>

    //复选框
    $(document).on("click",".cart_id",function(){
        var cart_id=new Array();
        $(".cart_id:checked").each(function(){
            cart_id.push($(this).val());
        });
        $.ajax({
            url:"/index/manydel",
            data:{cart_id:cart_id},
            type:"post",
            dataType:"json",
            success:function(res){
                if(res.code=='0000'){
                    $(".summoney").text(res.total.total);
                }
            }
        })

    })
    //全选
    $(document).on('click',"input[class='checkbox']",function(){
        if($(this).prop('checked')){
            $("input[class='checkbox']").prop('checked', true);
            $("input[class='cart_id']").prop('checked', true);
            var cart_id=new Array();
            $(".cart_id:checked").each(function(){
                cart_id.push($(this).val());
            });
            $.ajax({
                url:"/index/manydel",
                data:{cart_id:cart_id},
                type:"post",
                dataType:"json",
                success:function(res){
                    if(res.code=='0000'){
                        $(".summoney").text(res.total.total);
                    }
                }
            })
        }else{
            $("input[class='checkbox']").prop('checked', false);
            $("input[class='cart_id']").prop('checked', false);
            $(".summoney").text(0);
        }
    })


    $(document).on("click",".sum-btn",function(){
            var cart_id=new Array();
        $(".cart_id:checked").each(function(){
            cart_id.push($(this).val());
        });
        window.location.href="settl?cart_id="+cart_id;
    })
    //+
    $(document).on("click",".plus",function(){
        var type=$(this).text();
        var cart_id=$(this).prev().attr('cart_id');
        var buy_number = $(this).prev(".itxt").val();
        $.ajax({
            url:"/index/getTypePrice",
            data:{type:type,cart_id:cart_id,buy_number:buy_number},
            type:"post",
            dataType:"json",
            success:function(res){
//                console.log(res);return;
                    if(res.code=='0000'){
                        $("input[cart_id='"+cart_id+"']").val(res.buy_number);
                        $(".sum").text(res.total.total);
//                        $("span[cart_id='"+cart_id+"']").text(res.total.total);
                    }
            }
        })
    })
    //-
    $(document).on("click",".mins",function(){
        var type=$(this).text();
        var cart_id=$(this).next().attr('cart_id');
        var buy_number = $(this).next(".itxt").val();
        $.ajax({
            url:"/index/getTypePrices",
            data:{type:type,cart_id:cart_id,buy_number:buy_number},
            type:"post",
            dataType:"json",
            success:function(res){
                if(res.code=='0000'){
                    $("input[cart_id='"+cart_id+"']").val(res.buy_number);
                    $(".sum").text(res.total.total);
//                        $("span[cart_id='"+cart_id+"']").text(res.total.total);
                }
            }
        })
    })
    //文本框
    $(document).on("blur",".itxt",function(){
        var buy_number=$(this).val();
        var cart_id=$(this).attr("cart_id");
        var res=/^\+?[1-9][0-9]*$/;
        if(!res.test(buy_number)){
            alert("购买数量有误！！！");return;
        }
        $.ajax({
            url:"/index/getInputPrice",
            data:{buy_number:buy_number,cart_id:cart_id},
            type:"post",
            dataType:"json",
            success:function(res){
                if(res.code=='0000'){
                    $("input[cart_id='"+cart_id+"']").val(res.buy_number);
                    $(".sum").text(res.total.total);
                }
            }
        })
    })
    //单删
    $(document).on("click","#del",function(){
        var cart_id=$("#del").attr("cart_id");
        $.ajax({
            url:"/index/del",
            data:{cart_id:cart_id},
            type:"post",
            dataType:"json",
            success:function(res){
                if(res.code=="0000"){
                    alert(res.msg);
                    location=location;
                }
            }
        })
    })



</script>
</html>