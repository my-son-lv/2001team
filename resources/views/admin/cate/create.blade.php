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
        <title>分类管理</title>
        <meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" name="viewport">
    </head>
    <body class="hold-transition skin-red sidebar-mini">
    <!-- .box-body -->
    <div class="box-header with-border">
        <h3 class="box-title">分类管理</h3>
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
                    <th class="sorting_asc">分类id</th>
                    <th class="sorting">分类名称</th>
                    <th class="sorting">父级id</th>
                    <th class="sorting">是否展示</th>
                    <th class="sorting">是否导航栏展示</th>
                    <th class="text-center">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cateinfo as $v)
                    <tr pid="{{$v->pid}}" cate_id="{{$v->cate_id}}" style="display: none">
                        <td>
                            <a href="javascript:;" class='showHide' style="color:red;">+</a>
                            {{$v->cate_id}}
                        </td>
                        <td></td>
                        <td>{{str_repeat('|——',$v->level)}}{{$v->cate_name}}</td>
                        <td>{{$v->pid}}</td>
                        <td class="changeValue" field="cate_show" value="{{$v->cate_show}}"> @if($v->cate_show == 1) √ @else × @endif</td>
                        <td class="changeValue" field="cate_nav_show" value="{{$v->cate_nav_show}}">@if($v->cate_nav_show == 1) √ @else × @endif</td>
                        <td class="text-center">
                            <a href="javascript:void(0)" onclick="DeleteGetId({{$v->cate_id}},this)">
                            <button type="button" class="btn bg-olive btn-xs del" data-target="#editModal">删除</button>
                            </a>
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
    <form>
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">分类添加</h3>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered table-striped"  width="800px">
                            <tr>
                                <td>分类名称</td>
                                <td><input id="butti_name" name="butti_name" type="text" class="form-control" placeholder="分类名称" > </td>
                            </tr>
                            <tr>
                                <td>父级分类</td>
                                <td>
                                    <select name="pid" id="pid">
                                        <option value="0">父级分类</option>
                                        @foreach($cateinfo as $v)
                                        <option value="{{$v->cate_id}}">{{str_repeat('|——',$v->level)}}{{$v->cate_name}}</option>
                                            @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>是否展示</td>
                                <td>
                                    <input type="radio" id="cate_show" name="cate_show" value="1" title="是" checked="">
                                    <input type="radio" id="cate_show" name="cate_show" value="2" title="否">
                                </td>
                            </tr>
                            <tr>
                                <td>是否在导航栏展示</td>
                                <td>
                                    <input type="radio" id="cate_nav_show" name="cate_nav_show" value="1" title="是" checked="">
                                    <input type="radio" id="cate_nav_show" name="cate_nav_show" value="2" title="否">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" type="button" id="but"  data-dismiss="modal" aria-hidden="true">新增</button>
                        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </body>
    </html>
</div>

<script>
    $(document).on("click","#but",function(){
        var pid = $("#pid").val();
        var butti_name = $("#butti_name").val();
        var cate_show = $("#cate_show").val();
        var cate_nav_show = $("#cate_nav_show").val();
        $.ajax({
            url : "/admin/cate/store",
            data : {butti_name:butti_name,pid:pid,cate_show:cate_show,cate_nav_show:cate_nav_show},
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
    });

    $(".changeValue").click(function(){
        var _this=$(this);
        var cate_id=_this.parent().attr("cate_id");
        var _field=_this.attr('field');
        var sign=_this.text();
        var is_show=_this.attr('value');
        $.ajax({
            url:"{{url('/admin/cate/check_cateshows')}}",
            type:"post",
            data:{cate_id:cate_id,_field:_field,is_show:is_show},
            dataType:"json",
            success:function(res){
                  if(res.code=="0000"){
                      _this.text(res.data==1?'√':'x');
                      _this.attr('value',res.data);
                  }
            }
        })
    })

    //+
    $("tr[pid='0']").show();
    $(".showHide").click(function(){
        var _this=$(this);
        var sign=_this.text();
        var cate_id=_this.parents("tr").attr("cate_id");
        if(sign=="+"){
            var child=$("tr[pid='"+cate_id+"']");
            if(child.length>0){
                child.show();
                _this.text("-");
            }
        }else{
            $("tr[pid='"+cate_id+"']").hide();
            _this.text("+");
        }
    })

      //删除
    function   DeleteGetId(cate_id,obj){
        if(!cate_id){
            return;
        }
        $.get('/admin/cate/del/',{cate_id:cate_id},function(res){
            if(res.code==0000){
               alert(res.msg);
                window.location.href=res.url;
            }else{
                alert(res.msg);
            }
        })
    }



</script>


<!-- 内容区域 /-->
@include("frag.admin.admin_foot")

