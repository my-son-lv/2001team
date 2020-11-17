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
        <link rel="stylesheet" href="/status/layui/css/layui.css"  media="all">
        <title>优惠券管理</title>
        <meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" name="viewport">
    </head>
    <body class="hold-transition skin-red sidebar-mini">
    <!-- .box-body -->
    <div class="box-header with-border">
        <h3 class="box-title">优惠券管理</h3>
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
                    <th class="" style="padding-right:0px">
                        <input id="selall" type="checkbox" class="icheckbox_square-blue">
                    </th>
                    <th class="sorting_asc">序号</th>
                    <th class="sorting">优惠券名称</th>
                    <th class="sorting">优惠券开始时间</th>
                    <th class="sorting">优惠券结束时间</th>
                    <th class="sorting">优惠金额</th>
                    <th class="sorting">满多少开启优惠</th>
                    <th class="sorting">优惠范围</th>
                    <th class="text-center">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($res as $v)
                    <tr coupon_id="{{$v->coupon_id}}">
                        <td><input  type="checkbox" ></td>
                        <td> {{$v->coupon_id}}</td>
                        <td> {{$v->coupon_name}}</td>
                        <td>{{date('Y-m-d H:i:s',$v->start_time)}} </td>
                        <td> {{date('Y-m-d H:i:s',$v->end_time)}}</td>
                        <td>{{$v->coupon_price}} </td>
                        <td> {{$v->coupon_condition}}</td>
                        <td> {{$v->goods_id}}</td>
                        <td class="text-center">
                            <button type="button" class="btn bg-olive btn-xs del" data-target="#editModal"  >删除</button>
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
    {{--<form action="{{url('/admin/coupon/store')}}" method="post">--}}
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">优惠券添加</h3>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered table-striped"  width="800px">
                            <tr>
                                <td>优惠券名称</td>
                                <td><input  name="coupon_name" type="text" class="form-control" placeholder="优惠券名称" id="coupon_name"></td>
                            </tr>
                            <div class="layui-inline">
                                <label class="layui-form-label">优惠开始时间</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="start_time" class="layui-input" id="test5" placeholder="yyyy-MM-dd HH:mm:ss" >
                                </div>
                            </div>
                            <div class="layui-inline">
                                <label class="layui-form-label">优惠结束时间</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="end_time" class="layui-input" id="test6" placeholder="yyyy-MM-dd HH:mm:ss" >
                                </div>
                            </div>
                            <tr>
                                <td>优惠范围</td>
                                <td>
                                    <select name="goods_id" id="goods_id">
                                        <option value="0">----请选择----</option>
                                        @foreach($goods as $v)
                                        <option value="{{$v->goods_id}}">{{$v->goods_name}}</option>
                                            @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>优惠金额</td>
                                <td><input  name="coupon_price" class="form-control" type="text" placeholder="优惠金额"  id="coupon_price">  </td>
                            </tr>
                            <tr>
                                <td>满多少开启优惠</td>
                                <td><input  name="coupon_condition" class="form-control" type="text"  id="coupon_condition"></td>
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
    {{--</form>--}}
    </body>
    </html>
</div>
<!-- 内容区域 /-->
@include("frag.admin.admin_foot")
<script src="/status/layui/layui.js"></script>
<script>
    //JavaScript代码区域
    layui.use(['element','form','laydate'], function(){
        var element = layui.element,
                form=layui.form;
        var laydate = layui.laydate;
        //日期时间选择器
        laydate.render({
            elem: '#test5'
            ,type: 'datetime'
        });
        //日期时间选择器
        laydate.render({
            elem: '#test6'
            ,type: 'datetime'
        });
    });

    $(document).on("click","#but",function(){
        var coupon_name=$("#coupon_name").val();
        //开始时间
        var start_time=$("#test5").val();
        //结束时间
        var end_time=$("#test6").val();

        var goods_id=$("#goods_id").val();
        var coupon_price=$("#coupon_price").val();
        var coupon_condition=$("#coupon_condition").val();

        $.ajax({
            url:"/admin/coupon/store",
            data:{coupon_name:coupon_name,start_time:start_time,end_time:end_time,goods_id:goods_id,coupon_price:coupon_price,coupon_condition:coupon_condition},
            type:"post",
            dataType:"json",
            success:function(res){
                if(res.code==0000){
                    alert(res.message);
                    window.location.href="/admin/coupon/create";
                }else{
                    alert(res.msg);
                }
            }
        })
    });

    $(document).on("click",".del",function(res){
        var coupon_id=$(this).parents("tr").attr("coupon_id");
        $.ajax({
            url:"/admin/coupon/del",
            data:{coupon_id:coupon_id},
            type:"get",
            dataType:"json",
            success:function(res){
                if(res.code==0000){
                    alert(res.msg);
                    window.location.href=res.url;
                }else{
                    alert(res.msg);
                }
            }
        })
    })

</script>


