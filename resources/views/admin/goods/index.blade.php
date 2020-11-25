@include("frag.admin.admin_head")
@include("frag.admin.admin_left")
		<!-- 内容区域 -->
<div class="content-wrapper">
                    <div class="box-header with-border">
                        <h3 class="box-title">商品管理</h3>
                    </div>

                    <div class="box-body">

                        <!-- 数据表格 -->
                        <div class="table-box">

                            <!--工具栏-->
                            <div class="pull-left">
                                <div class="form-group form-inline">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default create" title="新建" ><i class="fa fa-file-o"></i> 新建</button>
                                        <button type="button" class="btn btn-default del" title="删除" ><i class="fa fa-trash-o"></i> 删除</button>
                                        {{--<button type="button" class="btn btn-default" title="提交审核" ><i class="fa fa-check"></i> 提交审核</button>--}}
                                        {{--<button type="button" class="btn btn-default" title="屏蔽" onclick='confirm("你确认要屏蔽吗？")'><i class="fa fa-ban"></i> 屏蔽</button>--}}
                                        <button type="button" class="btn btn-default" title="刷新" onclick="window.location.reload();"><i class="fa fa-refresh"></i> 刷新</button>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="box-tools pull-right">
                                <div class="has-feedback">
                                  状态：<select>
                                         	<option value="">全部</option>
                                         	<option value="0">未申请</option>
                                         	<option value="1">审核通过</option>
                                         	<option value="2">已驳回</option>
                                        </select>
							                  商品名称：<input >									
									<button class="btn btn-default" >查询</button>                                    
                                </div>
                            </div> -->
                            <!--工具栏/-->

			                  <!--数据列表-->
			                  <table id="dataList" class="table table-bordered table-striped table-hover dataTable">
			                      <thead>
			                          <tr>
			                              <th class="" style="padding-right:0px">
			                                  <input id="selall" type="checkbox" name="checkall" class="icheckbox_square-blue" >
			                              </th>
										  <th class="sorting_asc">商品ID</th>
									      <th class="sorting">商品名称</th>
									      <th class="sorting">商品价格</th>
									      <th class="sorting">商品库存</th>
									      <th class="sorting">是否上下架</th>
									      <th class="sorting">商品图片</th>
									      <th class="sorting">商品相册</th>
									      <th class="sorting">状态</th>									     						
					                      <th class="text-center">操作</th>
			                          </tr>
			                      </thead>
			                      <tbody>
								  @foreach($goods_info as $v)
			                          <tr>
			                              <td><input  type="checkbox" name="checkbox" class="checkbox" value="{{$v->goods_id}}"></td>
				                          <td>{{$v->goods_id}}</td>
									      <td>{{$v->goods_name}}</td>
									      <td>{{$v->goods_price}}</td>
									      <td>{{$v->goods_number}}</td>
									      <td>@if($v->is_shelf==1) 是 @else 否 @endif</td>
									      <td><img src="{{env('JUSTME_URL')}}{{$v->goods_img}}" alt="" width="120px" height="80px"></td>
									      <td>
											  @foreach($v->goods_imgs as $vv)
												  <img src="{{env('JUSTME_URL')}}{{$vv->goods_imgs}}" alt="" title="{{$vv->goods_title}}" width="120px" height="80px">
											  @endforeach
										  </td>
		                                  <td>
		                                  	<span>
												@if($v->goods_status==0) 未审核 @elseif($v->goods_status==1) 已通过 @elseif($v->goods_status==2) 驳回 @endif
		                                  	</span>

		                                  </td>		                                  
		                                  <td class="text-center">                                          
		                                 	  <button type="button" class="btn bg-olive btn-xs"><a href="{{url('/admin/goods/update?goods_id='.$v->goods_id)}}">修改</a></button>
		                                  </td>
			                          </tr>
								  @endforeach
			                      </tbody>

			                  </table>
			                  <!--数据列表/-->
							{{$goods_info->links()}}

                        </div>
                        <!-- 数据表格 /-->
                        
                        
                     </div>
                    <!-- /.box-body -->
</div>
<script>
	$(function(){
		$(document).on('click','.create',function(){
			window.location.href = "{{url('/admin/goods/create')}}";
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
				url:'/admin/goods/del',
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
@include("frag.admin.admin_foot")