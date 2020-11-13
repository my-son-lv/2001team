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
            <title>管理员管理</title>
            <meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" name="viewport">
        </head>
        <body class="hold-transition skin-red sidebar-mini">
        <!-- .box-body -->
        <div class="box-header with-border">
            <h3 class="box-title">管理员管理</h3>
        </div>
        <div class="box-body">
            <!-- 数据表格 -->
            <div class="table-box">
                <!--工具栏-->
                <div class="pull-left">
                    <div class="form-group form-inline">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default" title="新建" data-toggle="modal" data-target="#editModal" ><i class="fa fa-file-o"></i> 新建</button>
                            <button type="button" class="btn btn-default" title="删除" ><i class="fa fa-trash-o"></i> 删除</button>
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
                        
                        <th class="sorting_asc">管理员ID</th>
                        <th class="sorting">管理员昵称</th>
                        <th class="sorting">真实名称</th>
                        <th class="sorting">联系方式</th>
                        <th class="text-center">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($admininfo as $v)
                    <tr>
                        
                        <td>{{$v->admin_id}}</td>
                        <td>{{$v->admin_name}}</td>
                        <td>{{$v->admin_real_name}}</td>
                        <td>{{$v->admin_tel}}</td>
                        <td class="text-center">
                            <a href="{{url('/admin/admin/edit',['admin_id'=>$v->admin_id])}}">
                            <button type="button" class="btn btn-primary">编辑</button>
                            </a>
                            <button type="button" class="btn btn-danger" value="{{$v->admin_id}}" id="del">删除</button>
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
        <!-- 编辑窗口 -->
        <form id="brandform" action="{{url('admin/admin/store')}}" method="post">
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">管理员添加</h3>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered table-striped"  width="800px">
                            <tr>
                                <td>管理员昵称</td>
                                <td><input id="admin_name" name="admin_name" type="text" class="form-control" placeholder="管理员昵称" >  </td>
                            </tr>

                            <tr>
                                <td>管理员密码</td>
                                <td><input id="admin_pwd" name="admin_pwd" type="password" class="form-control" placeholder="管理员密码" >  </td>
                            </tr>

                            <tr>
                                <td>真实名称</td>
                                <td><input id="admin_real_name" name="admin_real_name" type="text" class="form-control" placeholder="真实名称" >  </td>
                            </tr>

                            <tr>
                                <td>联系方式</td>
                                <td><input id="admin_tel" name="admin_tel" type="tel" class="form-control" placeholder="联系方式" >  </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" type="button" id="but" data-dismiss="modal" aria-hidden="true">新增</button>
                        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
        </body>
        </html>
    </div>
    <!-- 内容区域 /-->
</div>
</body>
</html>
<script>
    $(document).on("click","#but",function(){
        var formData = new FormData($("#brandform")[0]);
        var Data = $("#brandform").serialize();
        formData.append('data',Data);
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            url : "/admin/admin/store",
            data : formData,
            dataType : "json",
            processData : false,
            contentType : false,
            type : "post",
            success:function(res){
                // console.log(res);
                if(res.code==0000){
                    alert('添加成功');
                    location.href='';
                }else{
                    alert('添加失败');
                    location.href='';
                }
            }
        })
    })
    $(document).on("click","#del",function(){
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        // alert(admin_id);
        if(confirm('是否删除')){
        var admin_id = $(this).val();
            $.ajax({
                url : "/admin/admin/del",
                data: {admin_id:admin_id},
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