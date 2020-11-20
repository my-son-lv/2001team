@include('admin.saller.public.top')
@include('admin.saller.public.left')
    <div class="content-wrapper">
            <!-- 正文区域 -->
            <section class="content">

                <div class="box-body">

                    <!--tab页-->
                    <div class="nav-tabs-custom">

                        <!--tab头-->
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#home" data-toggle="tab">商品基本信息</a>
                            </li>
                            <!-- <li >
                                <a href="#customAttribute" data-toggle="tab">扩展属性</a>                                                        
                            </li>      -->
                            <li >
                                <a href="#spec" data-toggle="tab" >规格</a>                                                        
                            </li>                       
                        </ul>
                        <!--tab头/-->
						
                        <!--tab内容-->
                        <div class="tab-content">

                            <!--表单内容-->
                            <div class="tab-pane active" id="home">
                                <div class="row data-type">                                  
								   <div class="col-md-2 title">商品分类</div>
									<input type="hidden" name="goods_id" value="{{$goods_info->goods_id}}">
		                           	  <div class="col-md-10 data">
		                           	  	<table>
		                           	  		<tr>
		                           	  			<td>
		                           	  				<select class="form-control cate_id" name="cate_id">
														<option value="0">父级分类</option>
														@foreach($cateinfo as $v)
															<option value="{{$v->cate_id}}" @if($goods_info->cate_id==$v->cate_id) checked @endif>{{str_repeat('|——',$v->level)}}{{$v->cate_name}}</option>
														@endforeach
		                           	  				</select>
		                              			</td>
		                           	  		</tr>
		                           	  	</table>
		                              	
		                              </div>	                              
		                          	  
									
		                           <div class="col-md-2 title">商品名称</div>
		                           <div class="col-md-10 data">
		                               <input type="text" class="form-control" name="goods_name"   placeholder="商品名称" value="{{$goods_info->goods_name}}">
		                           </div>
		                           
		                           <div class="col-md-2 title">品牌</div>
		                           <div class="col-md-10 data">
		                              <select class="form-control brand_id" name="brand_id">
                                          @foreach($brand_info as $v)
                                          <option value="{{$v->brand_id}}" @if($v->brand_id==$goods_info->brand_id) selected @endif>{{$v->brand_name}}</option>
                                          @endforeach
                                      </select>
		                           </div>
		                           
		                           <div class="col-md-2 title">价格</div>
		                           <div class="col-md-10 data">
		                           	   <div class="input-group">
			                          	   <span class="input-group-addon">¥</span>
			                               <input type="text" class="form-control" name="goods_price"  placeholder="价格" value="{{$goods_info->goods_price}}">
		                           	   </div>
                                   </div>
                                   <div class="col-md-2 title">库存</div>
		                           <div class="col-md-10 data">
		                           	   <div class="input-group">
										   <span class="input-group-addon"> </span>
			                               <input type="text" class="form-control" name="goods_number"  placeholder="库存" value="{{$goods_info->goods_number}}">
		                           	   </div>
		                           </div>
									<div class="col-md-2 title">商品积分</div>
									<div class="col-md-10 data">
										<div class="input-group">
											<span class="input-group-addon"> </span>
											<input type="text" class="form-control" name="goods_points"  placeholder="商品积分" value="{{$goods_info->goods_points}}">
										</div>
									</div>
		                           <div class="col-md-2 title">是否热卖</div>
                                   <div class="col-md-10 data">
                                       <input type="radio" name="is_hot" value="1" @if($goods_info->is_hot==1) checked @endif>是
                                       <input type="radio" name="is_hot" value="2" @if($goods_info->is_hot==2) checked @endif>否
                                   </div>
                                   <div class="col-md-2 title">是否新品</div>
                                   <div class="col-md-10 data">
                                        <input type="radio" name="is_new" value="1" @if($goods_info->is_new==1) checked @endif>是
                                       <input type="radio" name="is_new" value="2" @if($goods_info->is_new==2) checked @endif>否
                                   </div>
                                   <div class="col-md-2 title">是否上下架</div>
                                   <div class="col-md-10 data">
                                        <input type="radio" name="is_shelf" value="1" @if($goods_info->is_shelf==1) checked @endif>是
                                       <input type="radio" name="is_shelf" value="2" @if($goods_info->is_shelf==2) checked @endif>否
                                   </div>
		                           <div class="col-md-2 title editer">商品介绍</div>
                                   <div class="col-md-10 data editer">
                                       <textarea id="content" style="width:800px;height:400px;" >{{$goods_info->content}}</textarea>{{--visibility:hidden;--}}
                                   </div>
                                   <div class="col-md-2 title editer">图片</div>
                                   <div class="col-md-10 data editer">
                                   <div class="layui-upload-drag" id="test10">
                                        <i class="layui-icon"></i>
                                        <p>点击上传，或将文件拖拽到此处</p>
                                        <div class="layui" id="uploadDemoView">
                                            <hr>
                                            <img src="{{env('JUSTME_URL')}}{{$goods_info->goods_img}}" alt="上传成功后渲染" style="max-width: 196px">
                                        </div>
                                        </div>
                                        <input type="hidden" name="goods_img" value="{{$goods_info->goods_img}}">
                                   </div>
                                   <div class="col-md-2 title editer">相册</div>
                                   <div class="col-md-10 data editer">
                                        <div class="layui-upload">
                                            <button type="button" class="layui-btn" id="test2">多图片上传</button> 
                                            <blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;">
                                                预览图：
                                                <div class="layui-upload-list" id="demo2"></div>
                                            </blockquote>
                                        </div>
                                        <div id="imgs"></div>
                                   </div>
		                           
		                                               
                                  
                                    
                                </div>
                            </div>
                            
                
                           
                           
                            <!--扩展属性-->
                            <!-- <div class="tab-pane" id="customAttribute">
                                <div class="row data-type">                                
	                                <div>
		                                <div class="col-md-2 title">扩展属性1</div>
				                        <div class="col-md-10 data">
				                              <input class="form-control" placeholder="扩展属性1">	            	 
				                        </div>
	                                </div>       
									<div>
		                                <div class="col-md-2 title">扩展属性2</div>
				                        <div class="col-md-10 data">
				                              <input class="form-control" placeholder="扩展属性2">	            	 
				                        </div>
	                                </div>  									
                                </div>
                            </div> -->
                      
                            <!--规格-->
                            <div class="tab-pane" id="spec">
                            	<div class="row data-type">
	                            	<div class="col-md-2 title">是否启用规格</div>
			                        <div class="col-md-10 data">
			                        	<input type="checkbox" id="specs" value="1">
			                            <button type="button" class="btn btn-default" title="自定义规格" data-target="#mySpecModal"  data-toggle="modal"  ><i class="fa fa-file-o"></i> 自定义规格</button>
			                        </div>
                            	</div>
                            	<p>
                            	<div>
	                                <div class="row data-type">
	                                @foreach($specs_name_info as $v)
		                                <div>
			                                <div class="col-md-2 title">{{$v->specs_name}}</div>
					                        <div class="col-md-10 data">
                                                @foreach($specs_val_info as $vv)
                                                    @if($v->specs_id==$vv->specs_id)
                                                    <span>
                                                        <input  type="checkbox" name="specs" specs_id="{{$v->specs_id}}" value="{{$vv->id}}">{{$vv->specs_val}}
                                                    </span>
                                                    @endif
                                                @endforeach
					                        </div>
		                                </div>
									@endforeach                                    
	                                </div>
									<div>
										<button class="btn btn-primary specs"><i class="fa fa-save"></i>确认</button>
	                                </div>
	                                <div class="row data-type modal-contents" hidden>
	                                	 <table class="table table-bordered table-striped table-hover dataTable">
						                    <thead>
						                        <tr id="box">
												    <th class="sorting">规格</th>
												    <th class="sorting">价格</th>
												    <th class="sorting">库存</th>
													<th class="sorting">操作</th>
											    </tr>
								            </thead>
									 	</table>
										<div class="modal-footer">
											<button class="btn btn-default" id="yin" data-dismiss="modal" aria-hidden="true">关闭</button>
										</div>
								
	                                </div>
	                                
	                            </div>
                            </div>
                            
                        </div>
                        <!--tab内容/-->
						<!--表单内容/-->
                    </div>
                   </div>
                  <div class="btn-toolbar list-toolbar">

				      <button class="btn btn-primary" id="ti" ng-click="setEditorValue();save()"><i class="fa fa-save"></i>保存</button>
					  <button class="btn btn-default index" ng-click="goListPage()">返回列表</button>
				  </div>
            </section>
<!-- 自定义规格窗口 -->
<div class="modal fade" id="mySpecModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" >
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">自定义规格</h3>
		</div>
		<div class="modal-body">
			<table class="table table-bordered table-striped">
		      	<tr>
		      		<td>规格名称</td>
		      		<td><input  class="form-control" placeholder="规格名称" name="specs_name" ng-model="spec_entity.text">  </td>
		      	</tr>
		      	<tr>
		      		<td>规格选项(用逗号分隔)</td>
		      		<td>
						<input  class="form-control" placeholder="规格选项" name="specs_val" ng-model="spec_entity.values">
		      		</td>
		      	</tr>
			 </table>
		</div>
		<div class="modal-footer">
			<button class="btn btn-success specs_submit" ng-click="add_spec_entity()"  data-dismiss="modal" aria-hidden="true">保存</button>
			<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</button>
		</div>
	  </div>
	</div>
</div>
            <!-- 正文区域 /-->
<script type="text/javascript">
//	var editor;
//	KindEditor.ready(function(K) {
//		editor = K.create('textarea[name="content"]', {
//			allowFileManager : true
//		});
//	});
	//文件上传
    layui.use('upload', function(){
        var $ = layui.jquery
        ,upload = layui.upload;
        //拖拽上传
        upload.render({
            elem: '#test10'
            ,url: '{{env('JUSTMES_URL')}}saller/goods/upload' //改成您自己的上传接口
            ,done: function(res){
            layer.msg('上传成功');
            layui.$('#uploadDemoView').removeClass('layui-hide').find('img').attr('src',res.data.url+res.data.urls);
            layui.$("input[name='goods_img']").attr('value',res.data.urls);
            }
        });

        //多图片上传
        upload.render({
            elem: '#test2'
            ,url: '{{env('JUSTMES_URL')}}saller/goods/uploads' //改成您自己的上传接口
            ,multiple: true
            ,before: function(obj){
            //预读本地文件示例，不支持ie8
            obj.preview(function(index, file, result){
                $('#demo2').append('<img src="'+ result +'" alt="'+ file.name +'" wigth="50px" height="50px" class="layui-upload-img">');
            });
            }
            ,done: function(res){
                $("#imgs").append("<input type='hidden' name='goods_imgs' value='"+res.data.urls+"'> 备注：<input type='text' name='img_name' >");;
            //上传完毕
            }
        });
    });
	$(function(){
		//添加规格
		$(document).on('click','.specs_submit',function(){
			var specs_name = $("input[name='specs_name']").val();
			var specs_val = $("input[name='specs_val']").val();
			if(specs_name==""){
				alert('必填');return ;
			}
			if(specs_val==""){
				alert('必填！！！');return ;
			}
			$.ajax({
				url:'/saller/goods/specs',
				data:{specs_name:specs_name,specs_val:specs_val},
				type:'post',
				success:function(res){
					if(res.code=='0000'){
						alert(res.msg);
						location=location;
					}
				}
			})

		});
		//点击确定 开始运用笛卡尔积算法进行运算
		$(document).on('click','.specs',function(){
			var checkbox = document.getElementById("specs").checked;
			if(!checkbox){
				alert('您还没开启规格');return false;
			}
			var str = "";
			var arr = [];
			$.each($("input[name='specs']:checked"),function(){
				if(arr.length===0){
					console.log(1);
					arr[$(this).attr("specs_id")] = $(this).val()+',';
				}else{
					console.log(2);
					if(arr[$(this).attr("specs_id")]===undefined){
						console.log(3);
						arr[$(this).attr("specs_id")] = $(this).val()+',';
					}else{
						console.log(4);
						arr[$(this).attr("specs_id")] = arr[$(this).attr("specs_id")]+$(this).val()+',';
					}
				}
			});
			$.ajax({
				url:'/saller/goods/specs_create',
				data:{sku:arr},
				type:'post',
				dataType:'json',
				success:function(res){
					alert(res.msg);
	//				console.log(res);
					var html = "";
					$.each(res.data,function(k,v){
						html+="<tr> "+
								"<td name= 'sx' sku="+v.id.slice(0,v.id.length-1)+">"+v.sku+"</td> " +
								"<td><input type='text' name='num' id='num' value=''></td> " +
								"<td><input type='text' name='price' id='price' value=''> </td> "+
								"<td><input type='button' class='btn btn-primary but btn-success' value='确认' disabled> </td></tr> "
					});
					$("#box").after(html);
					$(".modal-contents").show();
				}
			})
		});
		$(document).on("click","#yin",function(){
			$(".modal-contents").hide();
		});
		var num = "";
		var price = "";
		var all = "";
		$(document).on("focus","#num",function () {//获取焦点
			$(".but").attr("disabled","false")
			$(this).parent().next().next().children().removeAttr("disabled")
		})
		$(document).on("focus","#price",function () {//获取焦点
			$(".but").attr("disabled","false")
			$(this).parent().next().children().removeAttr("disabled")
		})
		$(document).on("blur","#num",function () {
			num=$(this).val()
		})
		$(document).on("blur","#price",function () {
			price=$(this).val()
		})
		var str = "";
		//点击确认 把数据保存
		$(document).on('click','.but',function(){
			var sku = $(this).parent().prev().prev().prev().attr('sku');
			alert(num);
			alert(price);
			if(num==="" || price===""){
				alert('操作有误');
				return false;
			}
			all=+num+'@'+price+'@'+sku+'|';
			str+=all;
			console.log(str);return false;
		});
		//点击保存把保存的数据 传到控制器 进行MySQL添加
		$(document).on('click','#ti',function(){
			var goods_id = $("input[name='goods_id']").val();
			var content = $("#content").val();
			var cate_id = $(".cate_id").val();
			var brand_id = $(".brand_id").val();
			var goods_name = $("input[name='goods_name']").val();
			var goods_price = $("input[name='goods_price']").val();
			var goods_number = $("input[name='goods_number']").val();
			var goods_points = $("input[name='goods_points']").val();
			var is_hot = $("input[name='is_hot']").val();
			var is_new = $("input[name='is_new']").val();
			var is_shelf = $("input[name='is_shelf']").val();
			//获取图片和相册
			var goods_img = $("input[name='goods_img']").val();
			var goods_imgs = "";
			$("input[name='goods_imgs']").each(function(){
				goods_imgs +=$(this).val()+',';
			});
			var img_name = "";
			$("input[name='img_name']").each(function(){
				img_name +=$(this).val()+',';
			});


			var data = {};
			str = str.slice(0,str.length-1);
			// alert(str);return false;
			data.sku = str;
			data.goods_id = goods_id;
			data.content = content;
			data.cate_id = cate_id;
			data.brand_id = brand_id;
			data.goods_name = goods_name;
			data.goods_price = goods_price;
			data.goods_number = goods_number;
			data.goods_points = goods_points;
			data.is_hot = is_hot;
			data.is_new = is_new;
			data.is_shelf = is_shelf;
			data.goods_img = goods_img;
			data.goods_imgs = goods_imgs;
			data.img_name = img_name;
			$.ajax({
				url:"/saller/goods/store",
				type:'post',
				dataType:'json',
				data:data,
				success:function(res){
					// console.log(res);
					if(res.success){
						alert(res.msg);
						window.location.href = "{{url('/saller/goods')}}";
					}else{
						alert(res.msg);
					}
				}
			})
		})
		$(document).on('click','.index',function(){
			window.location.href = "{{url('/saller/goods')}}";
		});
	});
</script>
    </div>
@include('admin.saller.public.foot')