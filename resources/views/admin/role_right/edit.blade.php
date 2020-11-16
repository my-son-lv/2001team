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
    <title>管理员角色编辑</title>
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
                                <a href="#home" data-toggle="tab">角色权限信息</a>                             
                            </li>                            
                        </ul>
                        <!--tab头/-->
						
                        <!--tab内容-->
                        <div class="tab-content">

                            <!--表单内容-->
                            <form action="" id="brandform">
                            <div class="tab-pane active" id="home">
                                <div class="row data-type">                                  <input type="hidden" name="role_right_id" value="{{$info->role_right_id}}">
                                <div class="row data-type">                
                                    <div class="col-md-2 title">角色名称</div>
                                    <div class="col-md-10 data">
                                        <input type="text" name="role_name" value="{{$info->role_name}}" readonly>
                                    </div>
									</div>

                                    <div class="row data-type">                                  
                                    <div class="col-md-2 title">对应权限名称</div>
                                    <div class="col-md-10 data">
                                    @php $right_arr=explode(',',$info->right_id); @endphp
                                        @foreach($data as $v)
                                            <input type="checkbox" id="right_id" name="right_id" value="{{$v->right_id}}" @if(in_array($v->right_id,$right_arr)) checked @endif>{{$v->right_name}}
                                         @endforeach
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
        var role_right_id = $("input[name='role_right_id']").val();
        var right_id = [];
        $("#right_id:checked").each(function(i,n){
            right_id.push(n.value);
        })        
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        // console.log(right_id);return;
        $.ajax({
            url : "/admin/role_right/upd",
            data : {role_right_id:role_right_id,right_id:right_id},
            dataType : "json",
            type : "post",
            success:function(res){
                console.log(res);
                if(res.code==0000){
                    alert('编辑成功');
                    location.href='/admin/role_right/index';
                }else{
                    alert('编辑失败');
                    location.href='';
                }
            }
        })
    })
</script>

@include("frag.admin.admin_foot")