@include('admin.saller.public.top')
@include('admin.saller.public.left')
        <!-- 内容区域 -->
<div class="content-wrapper">
            <!-- 正文区域 -->
            <section class="content">

                <div class="box-body">

                    <!--tab页-->
                    <div class="nav-tabs-custom">

                        <!--tab头-->
                        <ul class="nav nav-tabs">
                       		
                            <li class="active">
                                <a href="#home" data-toggle="tab">商家信息</a>                             
                            </li>                            
                        </ul>
                        <!--tab头/-->
						
                        <!--tab内容-->
                        <div class="tab-content">

                            <!--表单内容-->
                            <div class="tab-pane active" id="home">
                                <div class="row data-type">
                                    <input type="hidden" name="saller_id" value="{{$saller_info_first['saller_id']}}">
                                    <div class="col-md-2 title">公司名称</div>
                                    <div class="col-md-10 data">
                                        <input type="text" class="form-control"  ng-model="entity.name" name="comp_name" placeholder="公司名称" value="{{$saller_info_first['comp_name']}}">
                                    </div>
									
									<div class="col-md-2 title">公司手机</div>
                                    <div class="col-md-10 data">
                                        <input type="text" class="form-control" ng-model="entity.mobile" name="comp_tel" placeholder="公司手机" value="{{$saller_info_first['comp_tel']}}">
                                    </div>
                                    
                                    <div class="col-md-2 title">公司详细地址</div>
                                    <div class="col-md-10 data">
                                        <input type="text" class="form-control"  ng-model="entity.addressDetail" name="comp_content" placeholder="公司详细地址" value="{{$saller_info_first['comp_content']}}">
                                    </div>
                                    
                                    <div class="col-md-2 title">联系人姓名</div>
                                    <div class="col-md-10 data">
                                        <input type="text" class="form-control" ng-model="entity.linkmanName" name="user_name"  placeholder="联系人姓名" value="{{$saller_info_first['user_name']}}">
                                    </div>
                                    
                                    <div class="col-md-2 title">联系人QQ</div>
                                    <div class="col-md-10 data">
                                        <input type="text" class="form-control" ng-model="entity.linkmanQq" name="user_qq"  placeholder="联系人QQ" value="{{$saller_info_first['user_qq']}}">
                                    </div>
                                    
                                    <div class="col-md-2 title">联系人手机</div>
                                    <div class="col-md-10 data">
                                        <input type="text" class="form-control" ng-model="entity.linkmanMobile" name="user_tel"  placeholder="联系人手机" value="{{$saller_info_first['user_tel']}}">
                                    </div>
                                    
                                    <div class="col-md-2 title">联系人EMAIL</div>
                                    <div class="col-md-10 data">
                                        <input type="text" class="form-control"  ng-model="entity.linkmanEmail" name="user_email" placeholder="联系人EMAIL" value="{{$saller_info_first['user_email']}}">
                                    </div>
                                    <div class="col-md-2 title">税务登记证号</div>
                                    <div class="col-md-10 data">
                                        <input type="text" class="form-control" ng-model="entity.taxNumber" name="taxation"  placeholder="税务登记证号" value="{{$saller_info_first['taxation']}}">
                                    </div>
                                    <div class="col-md-2 title">法定代表人</div>
                                    <div class="col-md-10 data">
                                        <input type="text" class="form-control" ng-model="entity.legalPerson"  name="legal_name" placeholder="法定代表人" value="{{$saller_info_first['legal_name']}}">
                                    </div>
                                    
 									<div class="col-md-2 title">法定代表人身份证号</div>
                                    <div class="col-md-10 data">
                                        <input type="text" class="form-control" ng-model="entity.legalPersonCardId" name="legal_number"  placeholder="法定代表人身份证号" value="{{$saller_info_first['legal_number']}}">
                                    </div>

 									<div class="col-md-2 title">开户行名称</div>
                                    <div class="col-md-10 data">
                                        <input type="text" class="form-control" ng-model="entity.bankName" name="bank_name" placeholder="开户行名称" value="{{$saller_info_first['bank_name']}}">
                                    </div>
                                    
                                    <div class="col-md-2 title">开户行支行</div>
                                    <div class="col-md-10 data">
                                        <input type="text" class="form-control" ng-model="entity.bankNameBranch" name="bank_bank_name" placeholder="开户行支行" value="{{$saller_info_first['bank_bank_name']}}">
                                    </div>

                                    <div class="col-md-2 title">银行账号</div>
                                    <div class="col-md-10 data">
                                        <input type="text" class="form-control"  ng-model="entity.bankCode" name="account_name" placeholder="银行账号" value="{{$saller_info_first['account_name']}}">
                                    </div>
                                    
                                </div>
                            </div>
                            
                            
                           
                            
                        </div>
                        <!--tab内容/-->
						<!--表单内容/-->
							 
                    </div>
                 	
                 	
                 	
                 	
                   </div>
                  <div class="btn-toolbar list-toolbar">
				      <button class="btn btn-primary saller_info" ng-click="save()"><i class="fa fa-save"></i>保存</button>
				      <a ng-click="submit()" data-toggle="modal" class="btn btn-danger">提交</a>
				  </div>
			
            </section>
            <!-- 正文区域 /-->
</div>
<!-- 内容区域 /-->
<script>
    //文件上传
    layui.use('upload', function() {
        var $ = layui.jquery
                , upload = layui.upload;
        //拖拽上传
        upload.render({
            elem: '#test10'
            , url: '{{env('JUSTMES_URL')}}admin/goods/upload' //改成您自己的上传接口
            , done: function (res) {
                layer.msg('上传成功');
                layui.$('#uploadDemoView').removeClass('layui-hide').find('img').attr('src', res.data.url + res.data.urls);
                layui.$("input[name='license']").attr('value', res.data.urls);
            }
        });
        //拖拽上传
        upload.render({
            elem: '#test11'
            , url: '{{env('JUSTMES_URL')}}admin/goods/upload' //改成您自己的上传接口
            , done: function (res) {
                layer.msg('上传成功');
                layui.$('#uploadDemoViews').removeClass('layui-hide').find('img').attr('src', res.data.url + res.data.urls);
                layui.$("input[name='code']").attr('value', res.data.urls);
            }
        });
    });
    $(document).on('click','.saller_info',function(){
        var comp_name = $("input[name='comp_name']").val();
        var comp_tel = $("input[name='comp_tel']").val();
        var comp_content = $("input[name='comp_content']").val();
        var user_name = $("input[name='user_name']").val();
        var user_qq = $("input[name='user_qq']").val();
        var user_tel = $("input[name='user_tel']").val();
        var user_email = $("input[name='user_email']").val();
        var taxation = $("input[name='taxation']").val();
        var legal_name = $("input[name='legal_name']").val();
        var legal_number = $("input[name='legal_number']").val();
        var bank_name = $("input[name='bank_name']").val();
        var bank_bank_name = $("input[name='bank_bank_name']").val();
        var account_name = $("input[name='account_name']").val();
        var saller_id = $("input[name='saller_id']").val();
        var data = {};
        data.comp_name = comp_name;
        data.comp_tel = comp_tel;
        data.comp_content = comp_content;
        data.user_name = user_name;
        data.user_qq = user_qq;
        data.user_tel = user_tel;
        data.user_email = user_email;
        data.taxation = taxation;
        data.legal_name = legal_name;
        data.legal_number = legal_number;
        data.bank_name = bank_name;
        data.bank_bank_name = bank_bank_name;
        data.account_name = account_name;
        data.saller_id = saller_id;
        $.ajax({
            url:"/saller/sallerdo",
            data:data,
            type:'post',
            dataType:'json',
            success:function(res){
//                console.log(res);
                if(res.code=='0000'){
                    alert(res.msg);
                    location=location;
                }else{
                    alert(res.msg);
                }
            }
        });
    });
</script>
@include('admin.saller.public.foot')