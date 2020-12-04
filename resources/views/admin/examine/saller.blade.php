@include("frag.admin.admin_head")
@include("frag.admin.admin_left")
    <div class="content-wrapper">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">商家管理</h3>
            </div>

            <div class="box-body">

                <!-- 数据表格 -->
                <div class="table-box">

                    <!--工具栏-->

                    <div class="box-tools pull-right">
                        <div class="has-feedback">
                            公司名称：<input  type="text" name="comp_name" value="{{$comp_name}}">
                            店铺名称： <input  type="text" name="saller_name" value="{{$saller_name}}">
                            状态：
                            <input type="radio" name="saller_status" value="0" @if($saller_status==0) checked @endif />未审核
                            <input type="radio" name="saller_status" value="1" @if($saller_status==1) checked @endif  />已通过
                            <input type="radio" name="saller_status" value="2" @if($saller_status==2) checked @endif  />审核未通过
                            <input type="radio" name="saller_status" value="3" @if($saller_status==3) checked @endif  />已关闭
                            <button class="btn btn-default where" >查询</button>
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
                            <th class="sorting">状态</th>
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
                                <td>
                                    @if($v->saller_status==0)
                                        <span>未审核</span>
                                    @elseif($v->saller_status==1)
                                        <span>已通过</span>
                                    @elseif($v->saller_status==2)
                                        <span>审核未通过</span>
                                    @elseif($v->saller_status==3)
                                        <span>已关闭</span>
                                    @endif
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




            <!-- 商家详情 -->
            <div class="modal fade" id="sellerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
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
                                    <table class="table table-bordered table-striped"  width="800px">
                                        <tr>
                                            <td>公司名称</td>
                                            <td>美琪数码经营店</td>
                                        </tr>
                                        <tr>
                                            <td>公司手机</td>
                                            <td>13900221212</td>
                                        </tr>
                                        <tr>
                                            <td>公司电话</td>
                                            <td>010-20112222</td>
                                        </tr>
                                        <tr>
                                            <td>公司详细地址</td>
                                            <td>北京市西三旗建材城西路888号</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="linkman">
                                    <br>
                                    <table class="table table-bordered table-striped" >
                                        <tr>
                                            <td>联系人姓名</td>
                                            <td>王美琪</td>
                                        </tr>
                                        <tr>
                                            <td>联系人QQ</td>
                                            <td>78223322</td>
                                        </tr>
                                        <tr>
                                            <td>联系人手机</td>
                                            <td>13500223322</td>
                                        </tr>
                                        <tr>
                                            <td>联系人E-Mail</td>
                                            <td>78223322@qq.com</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="certificate">
                                    <br>
                                    <table class="table table-bordered table-striped" >
                                        <tr>
                                            <td>营业执照号</td>
                                            <td>330106000109206</td>
                                        </tr>
                                        <tr>
                                            <td>税务登记证号</td>
                                            <td>0292039393011</td>
                                        </tr>
                                        <tr>
                                            <td>组织机构代码证号</td>
                                            <td>22320320302421</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="ceo">
                                    <br>
                                    <table class="table table-bordered table-striped" >
                                        <tr>
                                            <td>法定代表人</td>
                                            <td>王小聪</td>
                                        </tr>
                                        <tr>
                                            <td>法定代表人身份证号</td>
                                            <td>211030198503223122</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="bank">
                                    <br>
                                    <table class="table table-bordered table-striped" >
                                        <tr>
                                            <td>开户行名称</td>
                                            <td>中国建设银行北京市分行</td>
                                        </tr>
                                        <tr>
                                            <td>开户行支行</td>
                                            <td>海淀支行</td>
                                        </tr>
                                        <tr>
                                            <td>银行账号</td>
                                            <td>999000111222</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- 选项卡结束 -->


                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" data-dismiss="modal" aria-hidden="true">审核通过</button>
                            <button class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">审核未通过</button>
                            <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">关闭商家</button>
                            <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</button>
                        </div>
                    </div>
                </div>
            </div>

    </div>
    </div>

@include("frag.admin.admin_foot")
<script>
    $(document).on('click','.where',function(){
        var comp_name = $("input[name='comp_name']").val();
        var saller_name = $("input[name='saller_name']").val();
        var saller_status = $("input[name='saller_status']:checked").val();
        if(saller_status===undefined){
            saller_status="";
        }
        var str = "";
        if(comp_name!==''){
            str += 'comp_name='+comp_name+'&';
        }
        if(saller_name!==''){
            str += 'saller_name='+saller_name+'&';
        }
        if(saller_status!==''){
            str += 'saller_status='+saller_status+'&';
        }
        window.location.href="{{url('/admin/saller?')}}"+str;
    });
</script>