@include("frag.admin.admin_head")
@include("frag.admin.admin_left")
<div class="content-wrapper">
    <div class="" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">分类修改</h3>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-striped"  width="800px">
                        {{--<input type="hidden" id="cate_id" value="{{$coupon->coupon_id}}">--}}
                        <tr>
                            <td>分类名称</td>
                            <td><input  name="cate_name" type="text" class="form-control" placeholder="分类名称" id="cate_name" value=""></td>
                        </tr>
                        <tr>
                            <td>父级分类</td>
                            <td>
                                <select name="pid" id="pid">
                                    <option value="0">==父级分类==</option>
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
                    <button class="btn btn-success" type="button" id="but" data-dismiss="modal" aria-hidden="true">新增</button>
                    <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</button>
                </div>
            </div>
        </div>
    </div>
</div>
@include("frag.admin.admin_foot")
<script>
$(document).on("click","#but",function(){
    var cate_name=$("#cate_name").val();
    var pid=$("#pid").val();
    var cate_show=$('input[name="cate_show"]:checked').val();
    var cate_nav_show=$('input[name="cate_nav_show"]:checked').val();
    $.ajax({
        url:"/admin/cate/update_do",
        data:{cate_name:cate_name,pid:pid,cate_show:cate_show,cate_nav_show:cate_nav_show},
        type:"post",
        dataType:"json",
        success:function(res){
            if(res.code=='0000'){
                alert(res.msg);
                window.location.href=res.url;
            }else{
                alert(res.msg);
            }
        }
    })
})
</script>
