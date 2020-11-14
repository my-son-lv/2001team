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
        <form class="layui-form" id="photoForm">
            <!-- 正文区域 -->
            <section class="content">
                <div class="box-body">
                    <!--tab页-->
                    <div class="nav-tabs-custom">
                        <!--tab头-->
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#home" data-toggle="tab">广告信息</a>
                            </li>
                        </ul>
                        <!--tab头/-->
                        <!--tab内容-->
                        <div class="tab-content">
                            <!--表单内容-->
                            <input type="hidden" value="{{$data->advert_id}}" id="advert_id" name="advert_id">
                            <div class="tab-pane active" id="home">
                                <div class="row data-type">
                                    <div class="col-md-2 title">广告名称</div>
                                    <div class="col-md-10 data">
                                        <input type="text" value="{{$data->advert_name}}" id="advert_name" name="advert_name" class="form-control" ng-model="entity.linkmanMobile" placeholder="广告名称">
                                    </div>
                                    <div class="col-md-2 title">广告地址</div>
                                    <div class="col-md-10 data">
                                        <input type="text" class="form-control" ng-model="entity.linkmanEmail"  placeholder="广告地址" value="{{$data->advert_url}}">
                                    </div>
                                    <div class="col-md-2 title">广告图片</div>
                                    <div class="col-md-10 data">
                                        <input type="file" id="advert_logo" name="advert_logo">
                                        <img src="{{env("JUSTME_URL")}}{{$data->advert_logo}}" style="width:100px;height:800px" alt="">
                                    </div>
                                    <div class="col-md-2 title">开始时间</div>
                                    <div class="col-md-10 data">
                                        <div class="layui-inline">
                                            <div class="layui-input-inline">
                                                <input type="text" name="advert_add_time" class="layui-input" id="advert_add_time" placeholder="yyyy-MM-dd HH:mm:ss">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 title">结束时间</div>
                                    <div class="col-md-10 data">
                                        <div class="layui-inline">
                                            <div class="layui-input-inline">
                                                <input type="text" name="advert_end_time" class="layui-input" id="advert_end_time" placeholder="yyyy-MM-dd HH:mm:ss">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--tab内容/-->
                        <!--表单内容/-->
                    </div>
                </div>
                <div class="btn-toolbar list-toolbar">
                    <button type="button" class="btn btn-primary" id="but"><i class="fa fa-save"></i>保存</button>
                </div>
            </section>
        </form>
    </div>
    <!-- 内容区域 /-->
</div>
</body>
</html>
<script>
    $(document).on("click","#but",function(){
        var formData = new FormData($("#photoForm")[0]);
        $.ajax({
            url: "/admin/advert_upd_do",
            type: 'POST',
            dataType : "json",
            data: formData,
            contentType: false,
            processData: false,
            success: function (res) {
                if(res.code==0000){
                    alert(res.msg);
                    location.href=""
                }else{
                    alert(res.msg);
                    location.href=""
                }
            }
        });
    })

    $(document).on("click","#del",function(){
        var advert_id = $(this).val();
        $.ajax({
            url : "/admin/advert_del",
            dataType : "json",
            data : {advert_id:advert_id},
            type : "post",
            success:function(res){
                if(res.code==0002){
                    location.href="";
                }else{
                    location.href="";
                }
            }
        })
    })
</script>
<script>
    layui.use('laydate', function(){
        var laydate = layui.laydate;
        //日期时间选择器
        laydate.render({
            elem: '#advert_add_time'
            ,type: 'datetime'
        });
        laydate.render({
            elem: '#advert_end_time'
            ,type: 'datetime'
        });
    });
</script>
@include("frag.admin.admin_foot")