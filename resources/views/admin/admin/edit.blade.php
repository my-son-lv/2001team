@include("frag.admin.admin_head")
@include("frag.admin.admin_left")
        <!DOCTYPE html>
<html>
<head>
    <!-- 页面meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            <!-- 正文区域 -->
            <!DOCTYPE html>
<html>

<head>
    <!-- 页面meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>管理员修改</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" name="viewport">
  
    <link rel="stylesheet" href="../plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/adminLTE/css/AdminLTE.css">
    <link rel="stylesheet" href="../plugins/adminLTE/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="../css/style.css">
	<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="../plugins/bootstrap/js/bootstrap.min.js"></script>
   
    
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
                                <a href="#home" data-toggle="tab">商家信息</a>                             
                            </li>                            
                        </ul>
                        <!--tab头/-->
						
                        <!--tab内容-->
                        <div class="tab-content">

                            <!--表单内容-->
                            <form action="" id="brandform">
                            <div class="tab-pane active" id="home">
                                <div class="row data-type">                                  
                                    <input type="hidden" name="admin_id" value="{{$data->admin_id}}">
                                    <div class="col-md-2 title">管理员名称</div>
                                    <div class="col-md-10 data">
                                        <input type="text" class="form-control" value="{{$data->admin_name}}" name="admin_name" ng-model="entity.name"  placeholder="公司名称" value="">
                                    </div>
									
									<div class="col-md-2 title">管理员密码</div>
                                    <div class="col-md-10 data">
                                        <input type="password" class="form-control" value="{{$data->admin_pwd}}" name="admin_pwd" ng-model="entity.mobile"  placeholder="公司手机" value="">
                                    </div>
                                    
                                    <div class="col-md-2 title">真实名称</div>
                                    <div class="col-md-10 data">
                                        <input type="text" class="form-control" value="{{$data->admin_real_name}}" name="admin_real_name" ng-model="entity.telephone"  placeholder="公司电话" value="">
                                    </div>
                                    
                                    <div class="col-md-2 title">联系方式</div>
                                    <div class="col-md-10 data">
                                        <input type="text" class="form-control" value="{{$data->admin_tel}}" name="admin_tel" ng-model="entity.addressDetail"  placeholder="公司详细地址" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                        <!--tab内容/-->
						<!--表单内容/-->
                    </div>
                   </div>
                  <div class="btn-toolbar list-toolbar">
                  <button class="btn btn-success" type="button" id="but" data-dismiss="modal" aria-hidden="true">编辑</button>
				  </div>
			
            </section>
            <!-- 正文区域 /-->
			
       
</body>

</html>
            <!-- 内容区域 /-->
    </div>
</div>
</body>
</html>
<script>
    $(document).on("click","#but",function(){
        var formData = new FormData($("#brandform")[0]);
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

  
        $.ajax({
            url : "/admin/admin/upd",
            data : formData,
            dataType : "json",
            processData : false,
            contentType : false,
            type : "post",
            success:function(res){
                console.log(res);
                if(res.code==0000){
                    alert('编辑成功');
                    location.href='/admin/admin/index';
                }else{
                    alert('编辑失败');
                    location.href='';
                }
            }
        })
    })
</script>

@include("frag.admin.admin_foot")