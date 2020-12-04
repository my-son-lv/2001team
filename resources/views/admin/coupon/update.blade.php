@include("frag.admin.admin_head")
@include("frag.admin.admin_left")
<div class="content-wrapper">
<div class="" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">优惠券修改</h3>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped"  width="800px">
                    <input type="hidden" id="coupon_id" value="{{$coupon->coupon_id}}">
                    <tr>
                        <td>优惠券名称</td>
                        <td><input  name="coupon_name" type="text" class="form-control" placeholder="优惠券名称" id="coupon_name" value="{{$coupon->coupon_name}}"></td>
                    </tr>
                    <tr>
                        {{--@if($goods->goods_id==$v->goods_id) selected  @endif--}}
                        <td>优惠范围</td>
                        <td>
                            <select name="goods_id" id="goods_id">
                                <option value="0">----请选择----</option>
                                @foreach($goods as $v)
                                    <option value="{{$v['goods_id']}}" @if($coupon['goods_id']==$v['goods_id']) selected @endif id="goods_id">{{$v['goods_name']}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>优惠金额</td>
                        <td><input  name="coupon_price" class="form-control" type="text" placeholder="优惠金额"  id="coupon_price" value="{{$coupon->coupon_price}}"></td>
                    </tr>
                    <tr>
                        <td>满多少开启优惠</td>
                        <td><input  name="coupon_condition" class="form-control" type="text"  id="coupon_condition" value="{{$coupon->coupon_condition}}"></td>
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
        var coupon_name=$("#coupon_name").val();
        var coupon_price=$("#coupon_price").val();
        var coupon_condition=$("#coupon_condition").val();
        var goods_id=$("#goods_id").val();
        var coupon_id=$("#coupon_id").val();

        $.ajax({
            url:"/admin/coupon/update_do",
            data:{coupon_name:coupon_name,coupon_price:coupon_price,coupon_condition:coupon_condition,goods_id:goods_id,coupon_id:coupon_id},
            type:"post",
            dataType:"json",
            success:function(res){
                if(res.code=='0000'){
                    alert(res.msg);
                    window.location.href=res.url;
                }
            }
        })
    })
</script>
