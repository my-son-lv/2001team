@include("frag.admin.admin_head")
@include("frag.admin.admin_left")
        <!-- 内容区域 -->
<div class="content-wrapper">
    {{--<iframe width="100%" id="iframe" name="iframe"	onload="SetIFrameHeight()" frameborder="0" src="home.html"></iframe>--}}
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><center>砍价管理</center></title>
        <meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" name="viewport">
        <link rel="stylesheet" href="/status/layui/css/layui.css"  media="all">
        <script src="/status/layui/layui.js" charset="utf-8"></script>
    </head>
    <body class="hold-transition skin-red sidebar-mini">
    <!-- .box-body -->
    <div class="box-header with-border">
        <h3 class="box-title">砍价管理</h3>
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
                @if(!count($barg))
                <center><h1 style="color: red">暂无记录...</h1></center>
            @else
                <thead>
                <tr>
                    <th class="" style="padding-right:0px">
                        <input id="selall" type="checkbox" class="icheckbox_square-blue">
                    </th>
                    <th class="sorting_asc">砍价序号</th>
                    <th class="sorting">商品名称</th>
                    <th class="sorting">商品图片</th>
                    <th class="sorting">现价</th>
                    <th class="sorting">剩余价格</th>
                    <th class="sorting">需砍人数</th>
                    <th class="sorting">需砍价格</th>
                    <th class="sorting">上架数量</th>
                    <th class="sorting">开始时间</th>
                    <th class="sorting">结束时间</th>
                    <th class="text-center">操作</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($barg as $v)
                <tr>
                    <td><input  type="checkbox"></td>
                    <td>{{$v->barg_id}}</td>
                    <td>{{$v->goods_name}}</td>
                    <td><img src="{{env('JUSTME_URL')}}{{$v->goods_img}}" style="width: 100px;height: 100px" alt=""></td>
                    <td>{{$v->present_price}}元</td>
                    <td>{{$v->cut_price}}元</td>
                    <td>{{$v->cut_people}}人</td>
                    <td>{{$v->cut_shengyu}}元</td>
                    <td>{{$v->cut_number}}件</td>
                    <td>{{date('Y-m-d H:i:s'),$v->brag_add_time}}</td>
                    <td>{{date('Y-m-d H:i:s'),$v->brag_end_time}}</td>
                    <td class="text-center">
                        <button type="button" class="btn bg-olive btn-xs" data-toggle="modal" data-target="#editModal"  >修改</button>
                    </td>
                </tr>
                @endforeach
                    @endif
                </tbody>
            </table>
            <!--数据列表/-->
        </div>
        <!-- 数据表格 /-->
    </div>
    <!-- /.box-body -->
    <!-- 编辑窗口 -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">砍价新增</h3>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-striped"  width="800px">
                        <tr>
                            <td>商品</td>
                            <td>
                                <select name="" id="goods_id">
                                    <option value="">--请选择--</option>
                                    @foreach($goods as $v)
                                    <option value="{{$v->goods_id}}">{{$v->goods_name}}</option>
                                        @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>上架数量</td>
                            <td><input  class="form-control" id="cut_number" placeholder="上架数量">  </td>
                        </tr>
                        <tr>
                            <td>价格</td>
                            <td><input  class="form-control" id="cut_price" placeholder="上架价格">  </td>
                        </tr>
                        <tr>
                            <td>需砍人数</td>
                            <td><input  class="form-control" id="cut_people" placeholder="需砍人数">  </td>
                        </tr>
                        <tr>
                            <td>开始时间</td>
                            <td>
                                <div class="layui-inline">
                                    <div class="layui-input-inline">
                                        <input type="text" name="brag_add_time" class="layui-input" id="brag_add_time" placeholder="yyyy-MM-dd HH:mm:ss">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>结束时间</td>
                            <td>
                                <div class="layui-inline">
                                    <div class="layui-input-inline">
                                        <input type="text" name="brag_end_time" class="layui-input" id="brag_end_time" placeholder="yyyy-MM-dd HH:mm:ss">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" data-dismiss="modal" id="but" aria-hidden="true">保存</button>
                    <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</button>
                </div>
            </div>
        </div>
    </div>

    </body>
    </html>
</div>
<!-- 内容区域 /-->
<script>
    $(document).on("click","#but",function(){
        var goods_id = $("#goods_id").val();
        var cut_peoples = $("#cut_people").val();
        var cut_price = $("#cut_price").val();
        var cut_people = parseInt(cut_peoples);
        if(isNaN(cut_people)){
            alert("必须为数字");return
        }
        var brag_add_time = $("#brag_add_time").val();
        var brag_end_time = $("#brag_end_time").val();
        var cut_number = $("#cut_number").val();
        $.ajax({
            url : "/admin/barg_do",
            data : {cut_price:cut_price,cut_number:cut_number,goods_id:goods_id,cut_people:cut_people,brag_add_time:brag_add_time,brag_end_time:brag_end_time},
            dataType : "json",
            type : "post",
            success:function(res){
                if(res.code==0000){
                    alert(res.message)
                    location.href="";
                }else{
                    alert(res.message)
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
            elem: '#brag_add_time'
            ,type: 'datetime'
        });
        laydate.render({
            elem: '#brag_end_time'
            ,type: 'datetime'
        });
    });
</script>
{{--<script>--}}
    {{--function step(a){--}}
        {{--return function(x){--}}
            {{--return x+a++;--}}
        {{--}--}}
    {{--}--}}
    {{--var a = step(10);--}}
    {{--var b = step(20);--}}
    {{--alert(a(10));--}}
    {{--alert(b(20));--}}
    {{--var a="123abc";--}}
    {{--alert(typeof(a++));--}}
    {{--alert(a);--}}
{{--</script>--}}
<script>

</script>
@include("frag.admin.admin_foot")