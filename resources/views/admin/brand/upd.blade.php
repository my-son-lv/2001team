@include("frag.admin.admin_head")
@include("frag.admin.admin_left")

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
</head>
<body class="hold-transition skin-green sidebar-mini" >
<div class="wrapper">
    <!-- 内容区域 -->
    <div class="content-wrapper">
        {{--<iframe width="100%" id="iframe" name="iframe"	onload="SetIFrameHeight()" frameborder="0" src="home.html"></iframe>--}}
        <!DOCTYPE html>
        <html>
        <body class="hold-transition skin-red sidebar-mini">
            <div class="tab-pane active" id="home">
                <input type="hidden" id="brand_id" value="{{$info->brand_id}}">
                <div class="row data-type">
                    <div class="col-md-2 title">品牌名称</div>
                    <div class="col-md-10 data">
                        <input type="text" class="form-control"  name="brand_name" id="brand_name"  value="{{$info->brand_name}}">
                    </div>
                    <div class="col-md-2 title">品牌首字母</div>
                    <div class="col-md-10 data">
                        <input type="text" class="form-control"  name="brand_first_letter"  id="brand_first_letter"  value="{{$info->brand_first_letter}}">
                    </div>
                    <div class="col-md-2 title">品牌网址</div>
                    <div class="col-md-10 data">
                        <div class="input-group">
                            <input type="text" class="form-control"  name="brand_url"  id="brand_url" value="{{$info->brand_url}}">
                        </div>
                    </div>
                    <div class="btn-toolbar list-toolbar">
                        <button class="btn btn-primary"  type="button"><i class="fa fa-save"></i>修改品牌</button>
                    </div>
            </div>
            <!--tab内容/-->
            <!--表单内容/-->
    </div>
</div>
@include("frag.admin.admin_foot")
</body>
<script>
    $(document).on("click",".btn",function(){
        var brand_id=$("#brand_id").val();
        var brand_name=$("#brand_name").val();
        var brand_first_letter=$("#brand_first_letter").val();
        var brand_url=$("#brand_url").val();
        $.ajax({
            url:"/admin/brand/update_do",
            data:{brand_id:brand_id,brand_name:brand_name,brand_first_letter:brand_first_letter,brand_url:brand_url},
            type:"post",
            dataType:"json",
            success:function(res){
                if(res.code=="0000"){
                    alert(res.msg);
                    window.location.href=res.url;
                }else{
                    alert(res.msg);
                }
            }
        })
    })
</script>
</html>
