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
            <input type="hidden" id="butti_id" value="{{$butti->butti_id}}">
            <div class="row data-type">
                <div class="col-md-2 title">快报名称</div>
                <div class="col-md-10 data">
                    <input type="text" class="form-control"  name="butti_name" id="butti_name"  value="{{$butti->butti_name}}">
                </div>
                <div class="col-md-2 title">快报地址</div>
                <div class="col-md-10 data">
                    <input type="text" class="form-control"  name="butti_url"  id="butti_url"  value="{{$butti->butti_url}}">
                </div>
                <div class="col-md-2 title">快报发布人</div>
                <div class="col-md-10 data">
                    <div class="input-group">
                        <input type="text" class="form-control"  name="butti_people"  id="butti_people" value="{{$butti->butti_people}}">
                    </div>
                </div>
                <div class="btn-toolbar list-toolbar">
                    <button class="btn btn-primary"  type="button"><i class="fa fa-save"></i>修改快报</button>
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
        var butti_id=$("#butti_id").val();
        var butti_name=$("#butti_name").val();
        var butti_url=$("#butti_url").val();
        var butti_people=$("#butti_people").val();
        $.ajax({
            url:"/admin/update_do",
            data:{butti_id:butti_id,butti_name:butti_name,butti_url:butti_url,butti_people:butti_people},
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
