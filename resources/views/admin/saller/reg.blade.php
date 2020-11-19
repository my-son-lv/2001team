<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title>商家入驻申请</title>
    <link rel="stylesheet" type="text/css" href="/status/css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="/status/css/pages-register.css" />
	<link rel="stylesheet" href="/status/layui/css/layui.css"  media="all">
</head>

<body>
	<div class="register py-container ">
		<!--head-->
		<div class="logoArea">
			<a href="" class="logo"></a>
		</div>
		<!--register-->
		<div class="registerArea">
			<h3>商家入驻申请<span class="go">我有账号，去<a href="/saller/login" target="_blank">登陆</a></span></h3>
			<div class="info">
				<form class="sui-form form-horizontal">
				
					<div class="control-group">
						<label class="control-label">登陆名（不可修改）：</label>
						<div class="controls">
							<input type="text" placeholder="登陆名" name="username" class="input-xfat input-xlarge">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">登陆密码：</label>
						<div class="controls">
							<input type="password" placeholder="登陆密码" name="password" class="input-xfat input-xlarge">
						</div>
					</div>
				
					<div class="control-group">
						<label class="control-label">店铺名称：</label>
						<div class="controls">
							<input type="text" placeholder="店铺名称" name="saller_name" class="input-xfat input-xlarge">
						</div>
					</div>
				
					<div class="control-group">
						<label class="control-label">公司名称：</label>
						<div class="controls">
							<input type="text" placeholder="公司名称" name="comp_name" class="input-xfat input-xlarge">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">公司电话：</label>
						<div class="controls">
							<input type="text" placeholder="公司电话" name="comp_tel" class="input-xfat input-xlarge">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">公司详细地址：</label>
						<div class="controls">
							<input type="text" placeholder="公司详细地址" name="comp_content" class="input-xfat input-xlarge">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">联系人姓名：</label>
						<div class="controls">
							<input type="text" placeholder="联系人姓名" name="user_name" class="input-xfat input-xlarge">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">联系人QQ：</label>
						<div class="controls">
							<input type="text" placeholder="联系人QQ" name="user_qq" class="input-xfat input-xlarge">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">联系人手机：</label>
						<div class="controls">
							<input type="text" placeholder="联系人手机" name="user_tel" class="input-xfat input-xlarge">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">联系人EMAIL：</label>
						<div class="controls">
							<input type="text" placeholder="联系人EMAIL" name="user_email" class="input-xfat input-xlarge">
						</div>
					</div>
					{{--license 图片--}}
					<div class="control-group">
						<label class="control-label">营业执照号：</label>
						<div class="controls">
							<div class="layui-upload-drag" id="test10">
								<i class="layui-icon"></i>
								<p>点击上传，或将文件拖拽到此处</p>
								<div class="layui-hide" id="uploadDemoView">
									<hr>
									<img src="" alt="上传成功后渲染" style="max-width: 196px">
								</div>
							</div>
							<input type="hidden" name="license" value="">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">税务登记证号：</label>
						<div class="controls">
							<input type="text" placeholder="税务登记证号" name="taxation" class="input-xfat input-xlarge">
						</div>
					</div>
					{{--code 图片--}}
					<div class="control-group">
						<label class="control-label">组织机构代码证：</label>
						<div class="controls">
							<div class="layui-upload-drag" id="test11">
								<i class="layui-icon"></i>
								<p>点击上传，或将文件拖拽到此处</p>
								<div class="layui-hide" id="uploadDemoViews">
									<hr>
									<img src="" alt="上传成功后渲染" style="max-width: 196px">
								</div>
							</div>
							<input type="hidden" name="code" value="">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">法定代表人：</label>
						<div class="controls">
							<input type="text" placeholder="法定代表人" name="legal_name" class="input-xfat input-xlarge">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label">法定代表人身份证号：</label>
						<div class="controls">
							<input type="text" placeholder="法定代表人身份证号" name="legal_number" class="input-xfat input-xlarge">
						</div>
					</div>	

					<div class="control-group">
						<label class="control-label">开户行名称：</label>
						<div class="controls">
							<input type="text" placeholder="开户行名称" name="bank_name" class="input-xfat input-xlarge">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label">开户行支行：</label>
						<div class="controls">
							<input type="text" placeholder="开户行支行" name="bank_bank_name" class="input-xfat input-xlarge">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label">银行账号：</label>
						<div class="controls">
							<input type="text" placeholder="银行账号" name="account_name" class="input-xfat input-xlarge">
						</div>
					</div>
					
					<div class="control-group">
						<label for="inputPassword" class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
						<div class="controls">
							<input name="m1" type="checkbox" value="2" checked=""><span>同意协议并注册  <a href="sampling.html">《品优购商家入驻协议》</a></span>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label"></label>
						<div class="controls btn-reg">
							<a class="sui-btn   btn-danger saller_info" target="_blank">申请入驻</a>
						</div>
					</div>
				</form>
				<div class="clearfix"></div>
			</div>
		</div>
		<!--foot-->
		<div class="py-container copyright">
			<ul>
				<li>关于我们</li>
				<li>联系我们</li>
				<li>联系客服</li>
				<li>商家入驻</li>
				<li>营销中心</li>
				<li>手机品优购</li>
				<li>销售联盟</li>
				<li>品优购社区</li>
			</ul>
			<div class="address">地址：北京市昌平区建材城西路金燕龙办公楼一层 邮编：100096 电话：400-618-4000 传真：010-82935100</div>
			<div class="beian">京ICP备08001421号京公网安备110108007702
			</div>
		</div>
	</div>


<script type="text/javascript" src="/status/js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="/status/js/plugins/jquery.easing/jquery.easing.min.js"></script>
<script type="text/javascript" src="/status/js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="/status/js/plugins/jquery-placeholder/jquery.placeholder.min.js"></script>
<script type="text/javascript" src="/status/js/pages/register.js"></script>
	<script src="/status/layui/layui.js" charset="utf-8"></script>

</body>

</html>
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
		var username = $("input[name='username']").val();
		var password = $("input[name='password']").val();
		var saller_name = $("input[name='saller_name']").val();
		var comp_name = $("input[name='comp_name']").val();
		var comp_tel = $("input[name='comp_tel']").val();
		var comp_content = $("input[name='comp_content']").val();
		var user_name = $("input[name='user_name']").val();
		var user_qq = $("input[name='user_qq']").val();
		var user_tel = $("input[name='user_tel']").val();
		var user_email = $("input[name='user_email']").val();
		var license = $("input[name='license']").val();
		var taxation = $("input[name='taxation']").val();
		var code = $("input[name='code']").val();
		var legal_name = $("input[name='legal_name']").val();
		var legal_number = $("input[name='legal_number']").val();
		var bank_name = $("input[name='bank_name']").val();
		var bank_bank_name = $("input[name='bank_bank_name']").val();
		var account_name = $("input[name='account_name']").val();
		var data = {};
		data.username = username;
		data.password = password;
		data.saller_name = saller_name;
		data.comp_name = comp_name;
		data.comp_tel = comp_tel;
		data.comp_content = comp_content;
		data.user_name = user_name;
		data.user_qq = user_qq;
		data.user_tel = user_tel;
		data.user_email = user_email;
		data.license = license;
		data.taxation = taxation;
		data.code = code;
		data.legal_name = legal_name;
		data.legal_number = legal_number;
		data.bank_name = bank_name;
		data.bank_bank_name = bank_bank_name;
		data.account_name = account_name;

		$.ajax({
			url:"/saller/regdo",
			data:data,
			type:'post',
			dataType:'json',
			success:function(res){
				if(res.code=='0000'){
					alert(res.msg);
					window.location.href = "{{url('/saller/login')}}";
				}else{
					alert(res.msg);
				}
			}
		});
	});
</script>