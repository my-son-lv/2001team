@include("frag.admin.admin_head")
@include("frag.admin.admin_left")
<div class="content-wrapper">
                                
<!-- 商家详情 -->
<div id="sellerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" >
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3 id="myModalLabel">商家详情</h3>
		</div>
		<div class="modal-body">
			
			 <ul class="nav nav-tabs">
			  <li class="active"><a href="#home" data-toggle="tab">基本信息</a></li>
			  <li><a href="#linkman" data-toggle="tab">联系人</a></li>
			  <li><a href="#certificate" data-toggle="tab">证件</a></li>
			  <li><a href="#ceo" data-toggle="tab">法定代表人</a></li>
			  <li><a href="#bank" data-toggle="tab">开户行</a></li>
			</ul>
			
			<!-- 选项卡开始 -->         
		    <div id="myTabContent" class="tab-content">
			    <div class="tab-pane active in" id="home">
			      <br>
					<input type="hidden" name="saller_id" value="{{$saller_info->saller_id}}">
			      <table class="table table-bordered table-striped"  width="800px">
			      	<tr>
			      		<td>公司名称</td>
			      		<td>{{$saller_info->comp_name}}</td>
			      	</tr>
			      	<tr>
			      		<td>公司电话</td>
			      		<td>{{$saller_info->comp_tel}}</td>
			      	</tr>
			      	<tr>
			      		<td>公司详细地址</td>
			      		<td>{{$saller_info->comp_content}}</td>
			      	</tr>
			      </table>
      			</div>	
			    <div class="tab-pane fade" id="linkman">
			    	<br>
					<table class="table table-bordered table-striped" >
			      	<tr>
			      		<td>联系人姓名</td>
			      		<td>{{$saller_info->user_name}}</td>
			      	</tr>
			      	<tr>
			      		<td>联系人QQ</td>
			      		<td>{{$saller_info->user_qq}}</td>
			      	</tr>
			      	<tr>
			      		<td>联系人手机</td>
			      		<td>{{$saller_info->user_tel}}</td>
			      	</tr>
			      	<tr>
			      		<td>联系人E-Mail</td>
			      		<td>{{$saller_info->user_email}}</td>
			      	</tr>
			      </table>
			    </div>
			    <div class="tab-pane fade" id="certificate">
					<br>
					<table class="table table-bordered table-striped" >
				      	<tr>
				      		<td>营业执照号</td>
				      		<td><img src="{{env('JUSTME_URL')}}{{$saller_info->license}}" width="50px" height="50px" alt=""></td>
				      	</tr>
				      	<tr>
				      		<td>税务登记证号</td>
				      		<td>{{$saller_info->taxation}}</td>
				      	</tr>
				      	<tr>
				      		<td>组织机构代码证号</td>
				      		<td><img src="{{env('JUSTME_URL')}}{{$saller_info->code}}" width="50px" height="50px" alt=""></td>
				      	</tr>
			     	</table>
			    </div>
			    <div class="tab-pane fade" id="ceo">
					<br>
					<table class="table table-bordered table-striped" >
				      	<tr>
				      		<td>法定代表人</td>
				      		<td>{{$saller_info->legal_name}}</td>
				      	</tr>
				      	<tr>
				      		<td>法定代表人身份证号</td>
				      		<td>{{$saller_info->legal_number}}</td>
				      	</tr>					   			      	
			     	</table>
			    </div>
			    <div class="tab-pane fade" id="bank">
					<br>
					<table class="table table-bordered table-striped" >
				      	<tr>
				      		<td>开户行名称</td>
				      		<td>{{$saller_info->bank_name}}</td>
				      	</tr>
				      	<tr>
				      		<td>开户行支行</td>
				      		<td>{{$saller_info->bank_bank_name}}</td>
				      	</tr>
				      	<tr>
				      		<td>银行账号</td>
				      		<td>{{$saller_info->account_name}}</td>
				      	</tr>
			     	</table>
			    </div>
  			    </div>
           <!-- 选项卡结束 -->
			
			
		</div>
		<div class="modal-footer">						
			<button class="btn btn-success" data-dismiss="modal">审核通过</button>
         	<button class="btn btn-dangerd"  data-dismiss="modal">审核未通过</button>
            <button class="btn btn-danger" data-dismiss="modal">关闭商家</button>
			<button class="btn btn-default" data-dismiss="modal">关闭</button>
		</div>
	  </div>
	</div>
</div>
</div>
<script>
	$(function(){
		$(document).on('click','.btn-success',function(){
			var saller_id = $("input[name='saller_id']").val();
			$.ajax({
				url:'/admin/saller_examine/saller_true',
				data:{saller_id:saller_id},
				type:'post',
				dataType:'json',
				success:function(res){
//					console.log(res);
					if(res.success){
						alert(res.msg);
						window.location.href = "{{url('/admin/saller_exam')}}";
					}
				}
			})
		});
		$(document).on('click','.btn-dangerd',function(){
			var saller_id = $("input[name='saller_id']").val();
			$.ajax({
				url:'/admin/saller_examine/saller_false',
				data:{saller_id:saller_id},
				type:'post',
				dataType:'json',
				success:function(res){
//					console.log(res);
					if(res.success){
						alert(res.msg);
						window.location.href = "{{url('/admin/saller_exam')}}";
					}
				}
			})
		});
		$(document).on('click','.btn-danger',function(){
			var saller_id = $("input[name='saller_id']").val();
			$.ajax({
				url:'/admin/saller_examine/saller_down',
				data:{saller_id:saller_id},
				type:'post',
				dataType:'json',
				success:function(res){
//					console.log(res);
					if(res.success){
						alert(res.msg);
						window.location.href = "{{url('/admin/saller_exam')}}";
					}
				}
			})
		});
		$(document).on('click','.btn-default',function(){
			window.location.href = "{{url('/admin/saller_exam')}}";
		});
	});
</script>
@include("frag.admin.admin_foot")