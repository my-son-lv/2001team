@include("frag.admin.admin_head")
@include("frag.admin.admin_left")
    <div class="content-wrapper">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <a href="{{url('/admin/specs')}}" >
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </a>
                    <h3 id="myModalLabel">规格编辑</h3>
                </div>
                <div class="modal-body">

                    <table class="table table-bordered table-striped"  width="800px">
                        <tr>
                            <td>规格名称</td>
                            <td><input  class="form-control" name="specs_name" placeholder="规格名称" value="{{$specs_name_info->specs_name}}">  </td>
                        </tr>
                    </table>

                    <!-- 规格选项 -->
                    <div class="btn-group">
                        <button type="button"  id="xinjian" class="btn btn-default" title="新建" ><i class="fa fa-file-o"></i> 新增规格选项</button>
                    </div>

                    <table class="table table-bordered table-striped table-hover dataTable">
                        <thead>
                        <tr>
                            <th class="sorting">规格选项</th>
                            <th class="sorting">操作</th>
                        </thead>
                        <tbody>
                        @foreach($specs_val_info as $k=>$v)
                            <tr @if($k==0) class="specs" @else class="descspecs" @endif>
                                <td>
                                    <input  class="form-control" name="specs_val" value="{{$v->specs_val}}" placeholder="规格选项">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-default btn-del" title="删除" ><i class="fa fa-trash-o"></i> 删除</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" aria-hidden="true">保存</button>
                    <a href="{{url('/admin/specs')}}" >
                        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</button>
                        </a>
                </div>
            </div>
        </div>
    </div>
<script>
    $(document).on('click','.btn-success',function(){
        var specs_name = $("input[name='specs_name']").val();
        var specs_val = "";
        $("input[name='specs_val']").each(function(){
            specs_val+=$(this).val()+',';
        });
        specs_val=specs_val.slice(0,specs_val.length-1)

        $.ajax({
            url:"/admin/specs/create",
            data:{specs_name:specs_name,specs_val:specs_val},
            type:'post',
            success:function(res){
                if(res.code=='0000'){
                    alert(res.msg);
                    window.location.href="{{url('/admin/specs')}}";
                }
            }
        });
    });
    $(document).on('click','#xinjian',function(){
        var tr = $('.specs').clone();
        $('.specs').after(tr);
        $('.specs').last().addClass('descspecs').removeClass('specs');
    });
    $(document).on('click','.btn-del',function(){
        $(this).parents("tr[class='descspecs']").empty();
    });
</script>
@include("frag.admin.admin_foot")