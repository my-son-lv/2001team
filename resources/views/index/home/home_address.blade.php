<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>设置-个人信息</title>
    <link rel="icon" href="assets//status/img/favicon.ico">

    <link rel="stylesheet" type="text/css" href="/status/css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="/status/css/pages-seckillOrder.css" />
</head>

<body>
<!-- 头部栏位 -->
<!--页面顶部-->
@include("frag.index.index_top")

<script type="text/javascript" src="/status/js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
    $(function(){
        $("#service").hover(function(){
            $(".service").show();
        },function(){
            $(".service").hide();
        });
        $("#shopcar").hover(function(){
            $("#shopcarlist").show();
        },function(){
            $("#shopcarlist").hide();
        });

    })
</script>
<script type="text/javascript" src="/status/js/plugins/jquery.easing/jquery.easing.min.js"></script>
<script type="text/javascript" src="/status/js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="/status/js/plugins/jquery-placeholder/jquery.placeholder.min.js"></script>
<script type="text/javascript" src="/status/js/widget/nav.js"></script>
<script type="text/javascript" src="pages/userInfo/distpicker.data.js"></script>
<script type="text/javascript" src="pages/userInfo/distpicker.js"></script>
<script type="text/javascript" src="pages/userInfo/main.js"></script>
</body>
<!--header-->
<div id="account">
    <div class="py-container">
        <div class="yui3-g home">
            <!--左侧列表-->
            @include("frag.index.home_left")
            <!--右侧主内容-->
            <div class="yui3-u-5-6">
                <div class="body userAddress">
                    <div class="address-title">
                        <span class="title">地址管理</span>
                        <a data-toggle="modal" data-target=".edit" data-keyboard="false"   class="sui-btn  btn-info add-new">添加新地址</a>
                        <span class="clearfix"></span>
                    </div>
                    <div class="address-detail">
                        <table class="sui-table table-bordered">
                            <thead>
                            <tr>
                                <th>姓名</th>
                                <th>地址</th>
                                <th>联系电话</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>刘田田</td>
                                <td>北京 北京市 海淀区 上地街道东北旺西路8号中关村软件园9号楼</td>
                                <td>1774***********4</td>
                                <td>
                                    <a href="#">编辑</a>
                                    <a href="#">删除</a>
                                    默认地址
                                </td>
                            </tr>
                            <tr>
                                <td>沈沉</td>
                                <td>北京 北京市 海淀区 上地街道东北旺西路8号中关村软件园9号楼</td>
                                <td>1774***********4</td>
                                <td>
                                    <a href="#">编辑</a>
                                    <a href="#">删除</a>
                                    <a href="#">设为默认</a>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <!--新增地址弹出层-->
                    <div  tabindex="-1" role="dialog" data-hasfoot="false" class="sui-modal hide fade edit" style="width:580px;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" data-dismiss="modal" aria-hidden="true" class="sui-close">×</button>
                                    <h4 id="myModalLabel" class="modal-title">新增地址</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="" class="sui-form form-horizontal">
                                        <div class="control-group">
                                            <label class="control-label">收货人：</label>
                                            <div class="controls">
                                                <input type="text" class="input-medium">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">所在地区：</label>
                                            <div class="controls">
                                                <div data-toggle="distpicker">
                                                    <div class="form-group area">
                                                        <select class="form-control" id="province1"></select>
                                                    </div>
                                                    <div class="form-group area">
                                                        <select class="form-control" id="city1"></select>
                                                    </div>
                                                    <div class="form-group area">
                                                        <select class="form-control" id="district1"></select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">详细地址：</label>
                                            <div class="controls">
                                                <input type="text" class="input-large">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">联系电话：</label>
                                            <div class="controls">
                                                <input type="text" class="input-medium">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">邮箱：</label>
                                            <div class="controls">
                                                <input type="text" class="input-medium">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">地址别名：</label>
                                            <div class="controls">
                                                <input type="text" class="input-medium">
                                            </div>
                                            <div class="othername">
                                                建议填写常用地址：<a href="#" class="sui-btn btn-default">家里</a>　<a href="#" class="sui-btn btn-default">父母家</a>　<a href="#" class="sui-btn btn-default">公司</a>
                                            </div>
                                        </div>

                                    </form>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" data-ok="modal" class="sui-btn btn-primary btn-large">确定</button>
                                    <button type="button" data-dismiss="modal" class="sui-btn btn-default btn-large">取消</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- 底部栏位 -->
<!--页面底部-->
@include("frag.index.index_foot")
<!--页面底部END-->



undefined

</html>