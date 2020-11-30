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
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>品牌管理</title>
            <meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" name="viewport">
        </head>
        <body class="hold-transition skin-red sidebar-mini">
        <!-- .box-body -->
        <div class="box-header with-border">
            <h3 class="box-title">广告管理</h3>
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
                    <div class="has-feedback">
                    </div>
                </div>
                <!--工具栏/-->
                <!--数据列表-->
                <table id="dataList" class="table table-bordered table-striped table-hover dataTable">
                    <thead>
                    <tr>
                        <th class="" style="padding-right:0px">
                            <input id="selall" type="checkbox" class="icheckbox_square-blue">
                        </th>
                        <th class="sorting_asc">广告序号</th>
                        <th class="sorting">广告名称</th>
                        <th class="sorting">广告地址</th>
                        <th class="sorting">广告图片</th>
                        <th class="sorting">开始时间</th>
                        <th class="sorting">结束时间</th>
                        <th class="text-center">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $v)
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>{{$v->advert_id}}</td>
                        <td>{{$v->advert_name}}</td>
                        <td>{{$v->advert_url}}</td>
                        <td><img src="{{env("JUSTME_URL")}}{{$v->advert_logo}}" width="50px" height="50px"></td>
                        <td>{{date("Y-m-d H:i:s",$v->advert_add_time)}}</td>
                        <td>{{date("Y-m-d H:i:s",$v->advert_end_time)}}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-default"><a href="/admin/advert_upd/{{$v->advert_id}}">修改</a></button>
                            <button type="button" class="btn btn-danger" value="{{$v->advert_id}}" id="del">删除</button>
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
                <ul class="pagination">
                    {{$data->links()}}
                </ul>
                <!--数据列表/-->
            </div>
            <!-- 数据表格 /-->
        </div>
        <!-- /.box-body -->
        <!-- 编辑窗口 -->
        <form id="photoForm">
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">广告添加</h3>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered table-striped"  width="800px">
                            <tr>
                                <td>广告名称</td>
                                <td><input type="text" id="advert_name" name="advert_name" class="form-control" placeholder="广告名称" >  </td>
                            </tr>
                            <tr>
                                <td>广告图片</td>
                                <td>
                                    <input type="file" id="advert_logo" name="advert_logo">
                                </td>
                            </tr>
                            <tr>
                                <td>广告地址</td>
                                <td><input type="text" id="advert_url" name="advert_url" class="form-control" placeholder="广告地址" >  </td>
                            </tr>
                            <tr>
                                <td>开始时间</td>
                                <td>
                                    <div class="layui-inline">
                                        <div class="layui-input-inline">
                                            <input type="text" name="advert_add_time" class="layui-input" id="advert_add_time" placeholder="yyyy-MM-dd HH:mm:ss">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>结束时间</td>
                                <td>
                                    <div class="layui-inline">
                                        <div class="layui-input-inline">
                                            <input type="text" name="advert_end_time" class="layui-input" id="advert_end_time" placeholder="yyyy-MM-dd HH:mm:ss">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" data-dismiss="modal" aria-hidden="true" id="but">新增</button>
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
        var formData = new FormData($("#photoForm")[0]);
        $.ajax({
            url: "/admin/advert_do",
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