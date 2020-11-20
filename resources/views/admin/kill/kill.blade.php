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
                        <th class="sorting_asc">秒杀商品序号</th>
                        <th class="sorting">秒杀商品名称</th>
                        <th class="sorting">秒杀商品图片</th>
                        <th class="sorting">秒杀商品原价</th>
                        <th class="sorting">秒杀商品现价</th>
                        <th class="sorting">出售库存</th>
                        <th class="sorting">开始时间</th>
                        <th class="sorting">结束时间</th>
                        <th class="text-center">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($kill as $v)
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>{{$v->kill_id}}</td>
                            <td>{{$v->goods_name}}</td>
                            <td><img src="{{env('JUSTME_URL')}}{{$v->goods_img}}" style="width: 100px;height: 100px"></td>
                            <td>{{$v->goods_price}}</td>
                            <td>{{$v->goods_present}}</td>
                            <td>{{$v->numbers}}</td>
                            <td>{{date('Y-m-d H:i:s',$v->goods_add_time)}}</td>
                            <td>{{date('Y-m-d H:i:s',$v->goods_end_time)}}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-default"><a href="">修改</a></button>
                                <button type="button" class="btn btn-danger" value="" id="del">删除</button>
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
        <form id="photoForm">
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="myModalLabel">秒杀商品添加</h3>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered table-striped"  width="800px">
                                <tr>
                                    <td>秒杀商品</td>
                                    <td>
                                        <select name="goods_id" id="goods_id">
                                            <option value="">--请选择--</option>
                                            @foreach($goods as $v)
                                            <option value="{{$v->goods_id}}">{{$v->goods_name}}</option>
                                                @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>现价</td>
                                    <td>
                                        <input type="text" id="goods_present" name="goods_present" class="form-control" placeholder="现价" >
                                    </td>
                                </tr>
                                <tr>
                                    <td>出售库存</td>
                                    <td>
                                        <input type="text" id="goods_numbers" name="goods_numbers" class="form-control" placeholder="现价" >
                                    </td>
                                </tr>
                                <tr>
                                    <td>开始时间</td>
                                    <td>
                                        <div class="layui-inline">
                                            <div class="layui-input-inline">
                                                <input type="text" name="goods_add_time" class="layui-input" id="goods_add_time" placeholder="yyyy-MM-dd HH:mm:ss">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>结束时间</td>
                                    <td>
                                        <div class="layui-inline">
                                            <div class="layui-input-inline">
                                                <input type="text" name="goods_end_time" class="layui-input" id="goods_end_time" placeholder="yyyy-MM-dd HH:mm:ss">
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
<script>
    $(document).on("click","#but",function(){
        var goods_id = $("#goods_id").val();
        var goods_present = $("#goods_present").val();
        var goods_add_time = $("#goods_add_time").val();
        var goods_end_time = $("#goods_end_time").val();
        var goods_numbers = $("#goods_numbers").val();
        $.ajax({
            url : "/admin/kill_do",
            data : {goods_numbers:goods_numbers,goods_id:goods_id,goods_present:goods_present,goods_add_time:goods_add_time,goods_end_time:goods_end_time},
            dataType : "json",
            type : "post",
            success:function(res){
                if(res.code==0000){
                    alert(res.message)
                }else{
                    alert(res.message)
                }
            }
        })

    })
</script>
</html>
<script>
    layui.use('laydate', function(){
        var laydate = layui.laydate;
        //日期时间选择器
        laydate.render({
            elem: '#goods_add_time'
            ,type: 'datetime'
        });
        laydate.render({
            elem: '#goods_end_time'
            ,type: 'datetime'
        });
    });
</script>
@include("frag.admin.admin_foot")