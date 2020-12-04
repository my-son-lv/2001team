<div id="nav-bottom">
    <!--顶部-->
    <div class="nav-top">
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
                        <li class="f-item"><a href="/index/home">个人中心</a></li>
                        <li class="f-item space"></li>
                        <li class="f-item">我的品优购</li>
                        <li class="f-item space"></li>
                        <li class="f-item">品优购会员</li>
                        <li class="f-item space"></li>
                        <li class="f-item">企业采购</li>
                        <li class="f-item space"></li>
                        <li class="f-item">关注品优购</li>
                        <li class="f-item space"></li>
                        <li class="f-item" id="service">
                            <span>客户服务</span>
                            <ul class="service">
                                <li><a href="cooperation.html" target="_blank">合作招商</a></li>
                                <li><a href="shoplogin.html" target="_blank">商家后台</a></li>
                                <li><a href="cooperation.html" target="_blank">合作招商</a></li>
                                <li><a href="#">商家后台</a></li>
                            </ul>
                        </li>
                        <li class="f-item space"></li>
                        <li class="f-item">网站导航</li>
                    </ul>
                </div>
            </div>
        </div>

        <!--头部-->
        <div class="header">
            <div class="py-container">
                <div class="yui3-g Logo">
                    <div class="yui3-u Left logoArea">
                        <a class="logo-bd" title="品优购" href="javascript:;"></a>
                    </div>
                    <div class="yui3-u Center searchArea">
                        <div class="search">
                            <form action="" class="sui-form form-inline search_nav">
                                <!--searchAutoComplete-->
                                <div class="input-append">
                                    <input type="text" id="autocomplete" type="text" class="input-error input-xxlarge search_val" />
                                    <button class="sui-btn btn-xlarge btn-danger search_but" type="button">搜索</button>
                                </div>
                            </form>
                        </div>
                        <div class="hotwords">
                            <ul>
                                <li class="f-item">品优购首发</li>
                                <li class="f-item">亿元优惠</li>
                                <li class="f-item">9.9元团购</li>
                                <li class="f-item">每满99减30</li>
                                <li class="f-item">亿元优惠</li>
                                <li class="f-item">9.9元团购</li>
                                <li class="f-item">办公用品</li>

                            </ul>
                        </div>
                    </div>
                    <div class="yui3-u Right shopArea">
                        <div class="fr shopcar">
                            <div class="show-shopcar" id="shopcar">
                                <span class="car"></span>
                                <a class="sui-btn btn-default btn-xlarge" href="/index/cart">
                                    <span>我的购物车</span>
                                    <!-- <i class="shopnum">0</i> -->
                                </a>
                                <div class="clearfix shopcarlist" id="shopcarlist" style="display:none">
                                    <p>"啊哦，去购物车看看吧！"</p>
                                    <p>"啊哦，去购物车看看吧！"</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="yui3-g NavList">
                    <div class="yui3-u Left all-sort">
                        <h4><a href="/" style="color:white;">全部商品分类</a></h4>
                    </div>
                    <div class="yui3-u Center navArea">
                        <ul class="nav">
                            @foreach($cate["cate"] as $v)
                                <li class="f-item" value="{{$v['cate_id']}}"><a href="{{url('/index/index_list/'.$v['cate_id'])}}"  style="color:black;">{{$v['cate_name']}}</a></li>
                            @endforeach
                                <li class="f-item"><a href="/index/index_kill" target="_blank">秒杀</a></li>
                                <li class="f-item"><a href="" target="_blank">砍价</a></li>
                        </ul>
                    </div>
                    <div class="yui3-u Right"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/status/js/plugins/jquery/jquery.min.js"></script>
<script>
$(document).on('click',".search_but",function(){
    var search_val = $(".search_val").val();
    var url = "http://www.2001api.com/api/searchnav?callback=?";
    $.getJSON(url,{search_val:search_val},function(res){
        // alert('此功能暂未开发');
        // alert(res);
        if(res.code=='0000'){
            location.href="/index/index_show?goods_id="+res.goods_id;
        }else{
            alert(res.msg);
        }
    })
    // alert(search_val);
})
</script>