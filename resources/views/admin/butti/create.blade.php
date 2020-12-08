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
        <title>快报管理</title>
        <meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" name="viewport">
    </head>
    <body class="hold-transition skin-red sidebar-mini">
    <!-- .box-body -->
    <div class="box-header with-border">
        <h3 class="box-title">快报管理</h3>
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
            <form>
                <td><input type="text" name="butti_name" value="{{$butti->butti_name??''}}"></td>
                <td><input type="submit" value="搜索"></td>
            </form>
            <table id="dataList" class="table table-bordered table-striped table-hover dataTable">
                <thead>
                <tr>
                    <th class="" style="padding-right:0px">
                        <input id="selall" type="checkbox" class="icheckbox_square-blue">
                    </th>
                    <th class="sorting_asc">快报ID</th>
                    <th class="sorting">快报名称</th>
                    <th class="sorting">快报网址</th>
                    <th class="sorting">快报发布人</th>
                    <th class="sorting">快报发布时间</th>
                    <th class="text-center">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($butti as $v)
                    <tr butti_id="{{$v->butti_id}}">
                        <td><input  type="checkbox" ></td>
                        <td>{{$v->butti_id}}</td>
                        <td>{{$v->butti_name}}</td>
                        <td>{{$v->butti_url}}</td>
                        <td>{{$v->butti_people}}</td>
                        <td>{{date("Y-m-d H:i:s",$v->add_time)}}</td>
                        <td class="text-center">
                            <button type="button" class="btn bg-olive btn-xs" data-toggle="modal"  >
                                <a href="{{url("/admin/upd?butti_id=".$v->butti_id)}}">修改</a></button>
                            <button type="button" class="btn bg-olive btn-xs del" data-target="#editModal"  >删除</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <td>{{$butti->links()}}</td>
            <!--数据列表/-->
        </div>
        <!-- 数据表格 /-->
    </div>
    <!-- /.box-body -->
    <!-- 编辑窗口 -->
    <form id="brandform">
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">快报添加</h3>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered table-striped"  width="800px">
                            <tr>
                                <td>快报名称</td>
                                <td><input id="butti_name" name="butti_name" type="text" class="form-control" placeholder="快报名称" >  </td>
                            </tr>
                            <tr>
                                <td>快报网址</td>
                                <td><input id="butti_url" name="butti_url" class="form-control" type="text" placeholder="快报网址"></td>
                            </tr>
                            <tr>
                                <td>快报发布人</td>
                                <td><input id="butti_people" name="butti_people" class="form-control" type="text" placeholder="快报发布人" >  </td>
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
@include("frag.admin.admin_foot")
<script>
    $(document).on("click","#but",function(){
       var butti_name=$("#butti_name").val();
       var butti_url=$("#butti_url").val();
       var butti_people=$("#butti_people").val();
        $.ajax({
            url:"/admin/store",
            data:{butti_name:butti_name,butti_url:butti_url,butti_people:butti_people},
            type:"post",
            dataType:"json",
            success:function(res){
                if(res.code=="0000"){
                    alert(res.msg);
                    window.location.href=res.url;
                }else{
                    alert(res.msg)
                }
            }
        })
    })

    $(document).on("click",".del",function(){
        var butti_id=$(this).parents("tr").attr("butti_id");
        $.ajax({
            url:"/admin/del",
            data:{butti_id:butti_id},
            type:"post",
            dataType:"json",
            success:function(res){
                if(res.code=="0000"){
                    alert(res.msg);
                    window.location.href=res.url;
                }else{
                    alert(res.msg)
                }
            }
        })
    })
</script>

