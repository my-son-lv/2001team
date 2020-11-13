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
            <title>品牌管理</title>
            <meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" name="viewport">
        </head>
        <body class="hold-transition skin-red sidebar-mini">
        <!-- .box-body -->
        <div class="box-header with-border">
            <h3 class="box-title">品牌管理</h3>
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
                        <th class="sorting_asc">品牌ID</th>
                        <th class="sorting">品牌名称</th>
                        <th class="sorting">品牌首字母</th>
                        <th class="text-center">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><input  type="checkbox" ></td>
                        <td>1</td>
                        <td>联想</td>
                        <td>L</td>
                        <td class="text-center">
                            <button type="button" class="btn bg-olive btn-xs" data-toggle="modal" data-target="#editModal"  >修改</button>
                        </td>
                    </tr>
                    <tr>
                        <td><input  type="checkbox"></td>
                        <td>2</td>
                        <td>华为</td>
                        <td>H</td>
                        <td class="text-center">
                            <button type="button" class="btn bg-olive btn-xs" data-toggle="modal" data-target="#editModal"  >修改</button>
                        </td>
                    </tr>
                    <tr>
                        <td><input  type="checkbox"></td>
                        <td>3</td>
                        <td>三星</td>
                        <td>S</td>
                        <td class="text-center">
                            <button type="button" class="btn bg-olive btn-xs" data-toggle="modal" data-target="#editModal"  >修改</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <!--数据列表/-->
            </div>
            <!-- 数据表格 /-->
        </div>
        <!-- /.box-body -->
        <!-- 编辑窗口 -->
        <form id="brandform" action="">
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">品牌添加</h3>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered table-striped"  width="800px">
                            <tr>
                                <td>品牌名称</td>
                                <td><input id="brand_name" name="brand_name" type="text" class="form-control" placeholder="品牌名称" >  </td>
                            </tr>

                            <tr>
                                <td>品牌图片</td>
                                <td><input id="brand_logo" name="brand_logo" class="form-control" type="file">  </td>
                            </tr>

                            <tr>
                                <td>品牌url</td>
                                <td><input id="brand_url" name="brand_url" class="form-control" type="text" placeholder="品牌URL" >  </td>
                            </tr>

                            <tr>
                                <td>品牌大图</td>
                                <td><input id="brand_big_prc" name="brand_big_prc" class="form-control" type="file" placeholder="品牌名称" >  </td>
                            </tr>

                            <tr>
                                <td>首字母</td>
                                <td><input id="brand_first_letter"  name="brand_first_letter" class="form-control" type="text" placeholder="首字母">  </td>
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
        $.ajax({
            url : "/admin/brand_do",
            data : formData,
            dataType : "json",
            processData : false,
            contentType : false,
            type : "post",
            success:function(res){
                console.log(res);
            }
        })
    })
</script>

@include("frag.admin.admin_foot")