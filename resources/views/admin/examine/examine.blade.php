@include("frag.admin.admin_head")
@include("frag.admin.admin_left")
<div class="content-wrapper">
                
                    <div class="box-header with-border">
                        <h3 class="box-title">商品审核</h3>
                    </div>

                    <div class="box-body">

                        <!-- 数据表格 -->
                        <div class="table-box">

                            <!--工具栏-->
                            <div class="pull-left">
                                <div class="form-group form-inline">
                                    <div class="btn-group">
                                        {{--<button type="button" class="btn btn-default" title="删除" ><i class="fa fa-trash-o"></i> 删除</button>--}}
                                        <button type="button" class="btn btn-default exam_true" title="审核通过" ><i class="fa fa-check"></i> 审核通过</button>
                                        <button type="button" class="btn btn-default exam_false" title="驳回" ><i class="fa fa-ban"></i> 驳回</button>
                                        {{--<button type="button" class="btn btn-default" title="刷新" ><i class="fa fa-refresh"></i> 刷新</button>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="box-tools pull-right">
                                <div class="has-feedback">
                                    商品名称：<input >
									<button class="btn btn-default" >查询</button>                                    
                                </div>
                            </div>
                            <!--工具栏/-->

			                  <!--数据列表-->
			                  <table id="dataList" class="table table-bordered table-striped table-hover dataTable">
			                      <thead>
			                          <tr>
			                              <th class="" style="padding-right:0px">
			                                  <input id="selall" type="checkbox" class="icheckbox_square-blue">
			                              </th>
										  <th class="sorting_asc">商品ID</th>
									      <th class="sorting">商品名称</th>
									      <th class="sorting">商品价格</th>
									      <th class="sorting">所属商家</th>
									      <th class="sorting">状态</th>
					                      <th class="text-center">操作</th>
			                          </tr>
			                      </thead>
			                      <tbody>
									@foreach($goods_info as $v)
			                          <tr>
			                              <td><input type="checkbox" name="saller_id" value="{{$v->goods_id}}"></td>
				                          <td>{{$v->goods_id}}</td>
									      <td>{{$v->goods_name}}</td>
									      <td>{{$v->goods_price}}</td>
									      <td>{{$v->saller_name}}</td>
		                                  <td>
											  @if($v->goods_status==0)
		                                  	<span>
		                                  		待审核
		                                  	</span>
												  @elseif($v->goods_status==1)
												  <span>
		                                  		已通过
		                                  	</span>
											  @elseif($v->goods_status==2)
												  <span>
		                                  		驳回
		                                  	</span>
											  @endif
		                                  	
		                                  </td>		                                  
		                                  <td class="text-center">
		                                 	  <button type="button" class="btn bg-olive btn-xs" >详情</button>                  
		                                  </td>
			                          </tr>
									@endforeach
			                      </tbody>
								  {{$goods_info->links()}}
			                  </table>
			                  <!--数据列表/-->                        
							  
							 
                        </div>
                        <!-- 数据表格 /-->

					</div>
</div>
<script>
	$(function(){
		//通过
		$(document).on('click','.exam_true',function(){
			var goods_id = "";
			$('input[name="saller_id"]:checked').each(function(){
				goods_id += $(this).val()+',';
			});
			goods_id = goods_id.substr(0,goods_id.length-1);
			$.ajax({
				url:'/admin/examine/exam_true',
				data:{goods_id:goods_id},
				type:'post',
				dataType:'json',
				success:function(res){
//					console.log(res);
					if(res.success){
						alert(res.msg);
						location=location;
					}
				}
			})
		});
		//驳回
		$(document).on('click','.exam_false',function(){
			var goods_id = "";
			$('input[name="saller_id"]:checked').each(function(){
				goods_id += $(this).val()+',';
			});
			goods_id = goods_id.substr(0,goods_id.length-1);
			$.ajax({
				url:'/admin/examine/exam_false',
				data:{goods_id:goods_id},
				type:'post',
				dataType:'json',
				success:function(res){
//					console.log(res);
					if(res.success){
						alert(res.msg);
						location=location;
					}
				}
			})
		});
		$('#selall').on("click",function(){
			if($(this).is(':checked')){
				$('input[name="saller_id"]').each(function(){
					$(this).prop("checked",true);
				});
			}else{
				$('input[name="saller_id"]').each(function(){
					$(this).prop("checked",false);
				});
			}

		});
	})
</script>
@include("frag.admin.admin_foot")
