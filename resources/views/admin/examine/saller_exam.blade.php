@include("frag.admin.admin_head")
@include("frag.admin.admin_left")
<div class="content-wrapper">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">商家审核</h3>
                    </div>

                    <div class="box-body">

                        <!-- 数据表格 -->
                        <div class="table-box">

                            <!--工具栏-->
                            
                            <div class="box-tools pull-right">
                                <div class="has-feedback">
							        公司名称：<input  >
									店铺名称： <input  >									
									<button class="btn btn-default" >查询</button>                                    
                                </div>
                            </div>
                            <!--工具栏/-->

			                  <!--数据列表-->
			                  <table id="dataList" class="table table-bordered table-striped table-hover dataTable">
			                      <thead>
			                          <tr>
										  <th class="sorting_asc">商家ID</th>
									      <th class="sorting">公司名称</th>
									      <th class="sorting">店铺名称</th>
									      <th class="sorting">联系人姓名</th>
									      <th class="sorting">公司电话</th>
									     							
					                      <th class="text-center">操作</th>
			                          </tr>
			                      </thead>
			                      <tbody>
									@foreach($saller_info as $v)
			                          <tr>
				                          <td>{{$v->saller_id}}</td>
									      <td>{{$v->comp_name}}</td>
									      <td>{{$v->saller_name}}</td>
									      <td>{{$v->user_name}}</td>
									      <td>{{$v->comp_tel}}</td>
		                                 
		                                  <td class="text-center">
											  <a href="{{url('/admin/saller_examine?saller_id='.$v->saller_id)}}">
												  <button type="button" class="btn bg-olive btn-xs" data-toggle="modal" data-target="#sellerModal" >详情</button>
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
                    
	          
				</div>
</div>
@include("frag.admin.admin_foot")