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
                        <th class="sorting">广告位置序号</th>
                        <th class="sorting">类型</th>
                        <th class="sorting">宽</th>
                        <th class="sorting">高</th>
                        <th class="sorting">开始时间</th>
                        <th class="sorting">结束时间</th>
                        <th class="sorting">广告位置简介</th>
                        <th class="text-center">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $v)
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>{{$v->position_id}}</td>
                            <td>
                                @if($v->position_type==1)
                                    单图
                                    @elseif($v->position_type==2)
                                    多图
                                    @else
                                    文字
                                    @endif
                            </td>
                            <td>{{$v->position_width}}</td>
                            <td>{{$v->position_height}}</td>
                            <td>{{date("Y-m-d H:i:s",$v->position_add_time)}}</td>
                            <td>{{date("Y-m-d H:i:s",$v->position_end_time)}}</td>
                            <td>{{$v->position_desc}}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-link"><a href="/">查看</a></button>
                                <button type="button" class="btn btn-warning"><a href="/admin/position_advert/{{$v->position_id}}">生成广告</a></button>
                                <button type="button" class="btn btn-default"><a href="">修改</a></button>
                                <button type="button" class="btn btn-danger" value="" id="del">删除</button>
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
                            <h3 id="myModalLabel">广告位置添加</h3>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered table-striped"  width="800px">
                                <tr>
                                    <td>广告位置简介</td>
                                    <td><input type="text" id="position_desc" name="position_desc" class="form-control" placeholder="广告位置简介" ></td>
                                </tr>
                                <tr>
                                    <td>类型</td>
                                    <td>
                                        <input type="radio" id="position_type" name="position_type" value="1">单图
                                        <input type="radio" id="position_type" name="position_type" value="3">文字
                                    </td>
                                </tr>
                                <tr>
                                    <td>高</td>
                                    <td><input type="text" id="position_height" name="advert_url" class="form-control" placeholder="高" >  </td>
                                </tr>
                                <tr>
                                    <td>宽</td>
                                    <td><input type="text" id="position_width" name="advert_url" class="form-control" placeholder="宽" >  </td>
                                </tr>
                                <tr>
                                    <td>开始时间</td>
                                    <td>
                                        <div class="layui-inline">
                                            <div class="layui-input-inline">
                                                <input type="text" name="position_add_time" class="layui-input" id="position_add_time" placeholder="yyyy-MM-dd HH:mm:ss">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>结束时间</td>
                                    <td>
                                        <div class="layui-inline">
                                            <div class="layui-input-inline">
                                                <input type="text" name="position_end_time" class="layui-input" id="position_end_time" placeholder="yyyy-MM-dd HH:mm:ss">
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
        var position_desc = $("#position_desc").val();
        var position_height = $("#position_height").val();
        var position_width = $("#position_width").val();
        var position_add_time = $("#position_add_time").val();
        var position_end_time = $("#position_end_time").val();
        var position_type = $("#position_type:checked").val();
        $.ajax({
            url : "/admin/position_do",
            data : {position_type:position_type,position_desc:position_desc,position_height:position_height,position_width:position_width,position_add_time:position_add_time,position_end_time:position_end_time},
            dataType : "json",
            type : "post",
            success:function(res){
                if(res.code==0000){
                    alert(res.message);
                    location.href=""
                }else{
                    alert(res.message);
                    location.href=""
                }
            }
        })
    })
</script>

<script>
    layui.use(["laydate"], function(){
        var laydate = layui.laydate;
        //日期时间选择器
        laydate.render({
            elem: '#position_add_time'
            ,type: 'datetime'
        });
        laydate.render({
            elem: '#position_end_time'
            ,type: 'datetime'
        });
    });
</script>
@include("frag.admin.admin_foot")