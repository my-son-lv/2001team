@include("frag.admin.admin_head")
@include("frag.admin.admin_left")
        <!DOCTYPE html>
<html>
<head>
    <!-- 页面meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>根哥麻辣烫</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/status/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/status/plugins/adminLTE/css/AdminLTE.css">
    <link rel="stylesheet" href="/status/plugins/adminLTE/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="/status/css/style.css">
    <script src="/status/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="/status/plugins/jQueryUI/jquery-ui.min.js"></script>
    <script src="/status/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="/status/plugins/adminLTE/js/app.min.js"></script>
    <link rel="stylesheet" href="/status/layui/css/layui.css"  media="all">
    <script src="/status/layui/layui.js" charset="utf-8"></script>
</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
    <!-- 内容区域 -->
    <div class="content-wrapper">
        {{--<iframe width="100%" id="iframe" name="iframe"	onload="SetIFrameHeight()" frameborder="0" src="home.html"></iframe>--}}
        <!DOCTYPE html>
        <html>
        <head>
            <!-- 页面meta -->
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>生成广告</title>
            <!-- Tell the browser to be responsive to screen width -->
            <meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" name="viewport">
        </head>
        <body class="hold-transition skin-red sidebar-mini" >
        <!-- 正文区域 -->
        <section class="content">
            <div class="box-body">
                <!--tab页-->
                <div class="nav-tabs-custom">
                    <!--tab头-->
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#home" data-toggle="tab">生成广告</a>
                        </li>
                    </ul>
                    <!--tab头/-->
                    <!--tab内容-->
                    <div class="tab-content">
                        <!--表单内容-->
                        <div class="tab-pane active">
                            <div class="row data-type">
                                <div class="col-md-2 title">广告位置简介</div>
                                <div class="col-md-10 data">
                                    <center>
                                        <input type="hidden" id="position_id" value="{{$data['position_id']}}">
                                    {{$data['position_desc']}}
                                    </center>
                                </div>
                                <div class="col-md-2 title">广告</div>
                                <div class="col-md-10 data">
                                    @if($data["position_type"]==1)
                                        @foreach($advert as $v)
                                        <input type="radio" id="advert_id" name="advert_id" value="{{$v->advert_logo}}">{{$v->advert_name}}
                                        @endforeach
                                        @else
                                        @foreach($advert as $v)
                                            <input type="checkbox" id="advert_id" value="{{$v->advert_logo}}">{{$v->advert_name}}
                                        @endforeach
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--tab内容/-->
                    <!--表单内容/-->
                </div>
            </div>
            <div class="btn-toolbar list-toolbar">
                <button type="button" id="but" class="btn btn-success">生成</button>
            </div>
        </section>
        <!-- 正文区域 /-->
        </body>
        </html>
    </div>
    <!-- 内容区域 /-->
</div>
</body>
</html>

<script>
    $(document).on("click","#but",function(){
        var advert_logo = $("#advert_id:checked").val();
        var position_id = $("#position_id").val();
//        var advert_ids = [];
//        $("#advert_ids:checked").each(function(i,n){
//            advert_ids.push(n,value);
//        })
//        alert(advert_ids);return
        $.ajax({
            url : "/admin/position_advert_do",
            dataType : "json",
            data : {position_id:position_id,advert_logo:advert_logo},
            type : "post",
            success:function(res){
                if(res.code==0000){
                    alert(res.message);
                    location.href="/admin/position"
                }else{
                    alert(res.message);
                    location.href=""

                }
            }
        })
    })
</script>

@include("frag.admin.admin_foot")