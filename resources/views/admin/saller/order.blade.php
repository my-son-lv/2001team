@include('admin.saller.public.top')
@include('admin.saller.public.left')
		<!-- 内容区域 -->
<div class="content-wrapper">
                    <div class="box-header with-border">
                        <h3 class="box-title">订单管理</h3>
                    </div>

                    <div class="box-body">

                        <!-- 数据表格 -->
                        <div class="table-box">

                            <!--工具栏-->
                            {{--<div class="pull-left">--}}
                                {{--<div class="form-group form-inline">--}}
                                    {{--<div class="btn-group">--}}
                                        {{--<button type="button" class="btn btn-default create" title="新建" ><i class="fa fa-file-o"></i> 新建</button>--}}
                                        {{--<button type="button" class="btn btn-default del" title="删除" ><i class="fa fa-trash-o"></i> 删除</button>--}}
                                        {{--<button type="button" class="btn btn-default" title="提交审核" ><i class="fa fa-check"></i> 提交审核</button>--}}
                                        {{--<button type="button" class="btn btn-default" title="屏蔽" onclick='confirm("你确认要屏蔽吗？")'><i class="fa fa-ban"></i> 屏蔽</button>--}}
                                        {{--<button type="button" class="btn btn-default" title="刷新" onclick="window.location.reload();"><i class="fa fa-refresh"></i> 刷新</button>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="box-tools pull-right">--}}
                                {{--<div class="has-feedback">--}}
                                  {{--状态：<select>--}}
                                         	{{--<option value="">全部</option>--}}
                                         	{{--<option value="0">未申请</option>--}}
                                         	{{--<option value="1">审核通过</option>--}}
                                         	{{--<option value="2">已驳回</option>--}}
                                        {{--</select>--}}
							                  {{--商品名称：<input >--}}
									{{--<button class="btn btn-default" >查询</button>                                    --}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <!--工具栏/-->

			                  <!--数据列表-->
			                  <table id="dataList" class="table table-bordered table-striped table-hover dataTable">
			                      <thead>
			                          <tr>
										  <th class="sorting_asc">订单ID</th>
									      <th class="sorting">订单价格</th>
									      <th class="sorting">订单号</th>
									      <th class="sorting">下单时间</th>
									      <th class="sorting">支付方式</th>
									      <th class="sorting">订单状态</th>
									      <th class="sorting">操作</th>
			                          </tr>
			                      </thead>
			                      <tbody>
								  @foreach($order_info as $v)
			                          <tr>
				                          <td>{{$v->order_id}}</td>
									      <td>{{$v->order_price}}</td>
									      <td>{{$v->order_sn}}</td>
									      <td>{{date('Y-m-d H:i:s',$v->add_time)}}</td>
									      <td>{{$v->pay_name}}</td>
									      <td>@if($v->order_status==1)
										  		已支付
												  @elseif($v->order_status==2)
											  		已取消
												  @elseif($v->order_status==4)
											  		退货
												  @elseif($v->order_statua==0)
												  	正在付款
												  @endif
										  </td>
		                                  <td class="text-center">
		                                 	  <button type="button" class="btn bg-olive btn-xs"><a href="javascript:void(0)">详情</a></button>
		                                  </td>
			                          </tr>
								  @endforeach
			                      </tbody>

			                  </table>
			                  <!--数据列表/-->
							{{$order_info->links()}}

                        </div>
                        <!-- 数据表格 /-->
                        
                        
                     </div>
                    <!-- /.box-body -->
</div>
<script>
	$(function(){
		$(document).on('click','.create',function(){
			window.location.href = "{{url('/saller/goods/create')}}";
		});
		$('input[name="checkall"]').on("click",function(){
			if($(this).is(':checked')){
				$('input[name="checkbox"]').each(function(){
					$(this).prop("checked",true);
				});
			}else{
				$('input[name="checkbox"]').each(function(){
					$(this).prop("checked",false);
				});
			}
		});
		$(document).on('click','.del',function(){
			var goods_id = "";
			$("input[name='checkbox']:checked").each(function(){
				goods_id+=$(this).val()+',';
			})
			 goods_id = goods_id.substr(0,goods_id.length-1);
//			alert(goods_id);return ;
			$.ajax({
				url:'/saller/goods/del',
				data:{goods_id:goods_id},
				type:'post',
				dataType:'json',
				success:function(res){
					if(res.success){
						alert(res.msg);
						location=location;
					}
				}
			})

		});
	});
</script>
@include('admin.saller.public.foot')