@include("frag.admin.admin_head")
@include("frag.admin.admin_left")
  <!-- .box-body -->
<div class="content-wrapper">
                    <div class="box-header with-border">
                        <h3 class="box-title">规格管理</h3>
                    </div>
                    <div class="box-body">
                        <!-- 数据表格 -->
                        <div class="table-box">

                            <!--工具栏-->
                            <div class="pull-left">
                                <div class="form-group form-inline">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default" title="新建" data-toggle="modal" data-target="#editModal" ><i class="fa fa-file-o"></i> 新建</button>
                                        <button type="button" class="btn btn-default btn-dels" title="删除" ><i class="fa fa-trash-o"></i> 删除</button>
                                        
                                        <button type="button" class="btn btn-default" title="刷新" onclick="window.location.reload();"><i class="fa fa-refresh"></i> 刷新</button>
                                    </div>
                                </div>
                            </div>
                            {{--<div class="box-tools pull-right">--}}
                                {{--<div class="has-feedback">--}}
							                    {{--规格名称：<input  >									--}}
									{{--<button class="btn btn-default" >查询</button>                                    --}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <!--工具栏/-->
			                  <!--数据列表-->
			                  <table id="dataList" class="table table-bordered table-striped table-hover dataTable">
			                      <thead>
			                          <tr>
			                              <th class="" style="padding-right:0px">
			                                  <input id="selall" type="checkbox" class="icheckbox_square-blue">
			                              </th> 
										  <th class="sorting_asc">规格ID</th>
									      <th class="sorting">规格名称</th>									     												
					                      <th class="text-center">操作</th>
			                          </tr>
			                      </thead>
			                      <tbody>
									@foreach($specs_name_info as $v)
			                          <tr>
			                              <td><input  type="checkbox" ></td>			                              
				                          <td>{{$v->specs_id}}</td>
									      <td>{{$v->specs_name}}</td>
		                                  <td class="text-center">
											  <a href="{{url('/admin/specs/upd?specs_id='.$v->specs_id)}}" >
												  <button type="button" class="btn bg-olive btn-xs">修改</button>
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
	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog" >
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h3 id="myModalLabel">规格编辑</h3>
					</div>
					<div class="modal-body">

						<table class="table table-bordered table-striped"  width="800px">
							<tr>
								<td>规格名称</td>
								<td><input  class="form-control" name="specs_name" placeholder="规格名称" >  </td>
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
								  <tr class="specs">
										<td>
											<input  class="form-control specs_val" placeholder="规格选项">
										</td>
										<td>
											<button type="button" class="btn btn-default btn-del" title="删除" ><i class="fa fa-trash-o"></i> 删除</button>
										</td>
								  </tr>
								</tbody>
						  </table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-success" data-dismiss="modal" aria-hidden="true">保存</button>
						<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</button>
					</div>
				  </div>
				</div>
			</div>
	</div>
<script>
	$(document).on('click','.btn-success',function(){
		var specs_name = $("input[name='specs_name']").val();
		var specs_val = "";
		$(".specs_val").each(function(){
			specs_val+=$(this).val()+',';
		});
		if(specs_name==""){
			alert('不能为空');return ;
		}
		if(specs_val==""){
			alert('不能为空');return ;
		}
		specs_val=specs_val.slice(0,specs_val.length-1)
		$.ajax({
			url:"/admin/specs/create",
			data:{specs_name:specs_name,specs_val:specs_val},
			type:'post',
			success:function(res){
				if(res.code=='0000'){
					alert(res.msg);
					location=location;
				}
			}
		});
	});
	$(document).on('click','.btn-dels',function(){
		alert('该规格不能进行删除');
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