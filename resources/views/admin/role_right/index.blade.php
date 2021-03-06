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
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>角色权限管理</title>
            <meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" name="viewport">
        </head>
        <body class="hold-transition skin-red sidebar-mini">
        <!-- .box-body -->
        <div class="box-header with-border">
            <h3 class="box-title">角色权限管理</h3>
        </div>
        <div class="box-body">
            <!-- 数据表格 -->
            <div class="table-box">
                <!--工具栏-->
                <div class="pull-left">
                    <div class="form-group form-inline">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default" title="刷新" onclick="window.location.reload();"><i class="fa fa-refresh"></i> 刷新</button>
                        </div>
                    </div>
                </div>
                <div class="box-tools pull-right">
                    <div class="has-feedback"></div>
                </div>
                <!--工具栏/-->
                <!--数据列表-->
                <table id="dataList" class="table table-bordered table-striped table-hover dataTable">
                    <thead>
                    <tr>
                        
                        <th class="sorting_asc">角色权限ID</th>
                        <th class="sorting">角色名称</th>
                        <th class="sorting">对应权限</th>
                        <th class="sorting">添加时间</th>
                        <th class="text-center">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($info as $v)
                    <tr>
                        
                        <td>{{$v['role_right_id']}}</td>
                        <td>{{$v['role_name']}}</td>
                        <td>
                            <a href="{{url('/admin/role_right/edit',['role_right_id'=>$v['role_right_id']])}}">
                                <button type="button" class="btn btn-primary">点击查看</button>
                            </a>
                            <!-- @foreach($data as $vv)
                                @foreach($right_id as $vvv)
                                    @if($vv["right_id"]==$vvv)
                                        {{$vv["right_name"]}}
                                    @endif
                                @endforeach
                            @endforeach -->
                        </td>
                        <td>{{date("Y-m-d H:i:s",$v['add_time'])}}</td>
                        <td class="text-center">
                            @if(count($info)==1)
                            @else
                            <button type="button" class="btn btn-danger" value="{{$v['role_right_id']}}" id="del">删除</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    
                </table>
                <!--数据列表/-->
            </div>
            <!-- 数据表格 /-->
        </div>
        <!-- /.box-body -->
     
        </body>
        </html>
    </div>
    <!-- 内容区域 /-->
</div>
</body>
</html>
<script>
    $(document).on("click","#del",function(){
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        // alert(admin_id);
        if(confirm('是否删除')){
        var role_right_id = $(this).val();
            $.ajax({
                url : "/admin/role_right/del",
                data: {role_right_id:role_right_id},
                dataType : 'json',
                type : "post",
                success:function(res){
                    // console.log(res);
                    if(res.code==0000){
                        alert('删除成功');
                        location.href='';
                    }else{
                        alert('删除失败');
                        location.href='';
                    }
                }
            })
        }
    })
</script>

@include("frag.admin.admin_foot")