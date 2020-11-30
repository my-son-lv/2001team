@include('admin.saller.public.top')
@include('admin.saller.public.left')
        <!-- 内容区域 -->
<div class="content-wrapper">
    <div class="box-header with-border">
        <h3 class="box-title">订单管理</h3>
    </div>

    <div class="box-body">

        <!-- 数据表格 -->
        <div class="table-box">

            <!--工具栏-->
            {{--<div class="pull-left">--}}
            {{--<div class="form-group form-inline">--}}
            {{--<div class="btn-group">--}}
            {{--<button type="button" class="btn btn-default create" title="新建" ><i class="fa fa-file-o"></i> 新建</button>--}}
            {{--<button type="button" class="btn btn-default del" title="删除" ><i class="fa fa-trash-o"></i> 删除</button>--}}
            {{--<button type="button" class="btn btn-default" title="提交审核" ><i class="fa fa-check"></i> 提交审核</button>--}}
            {{--<button type="button" class="btn btn-default" title="屏蔽" onclick='confirm("你确认要屏蔽吗？")'><i class="fa fa-ban"></i> 屏蔽</button>--}}
            {{--<button type="button" class="btn btn-default" title="刷新" onclick="window.location.reload();"><i class="fa fa-refresh"></i> 刷新</button>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<div class="box-tools pull-right">--}}
            {{--<div class="has-feedback">--}}
            {{--状态：<select>--}}
            {{--<option value="">全部</option>--}}
            {{--<option value="0">未申请</option>--}}
            {{--<option value="1">审核通过</option>--}}
            {{--<option value="2">已驳回</option>--}}
            {{--</select>--}}
            {{--商品名称：<input >--}}
            {{--<button class="btn btn-default" >查询</button>                                    --}}
            {{--</div>--}}
            {{--</div>--}}
            <!--工具栏/-->

            <!--数据列表-->
            <table id="dataList" class="table table-bordered table-striped table-hover dataTable">
                <thead>
                <tr>
                    <th class="sorting_asc">订单ID</th>
                    <th class="sorting">订单价格</th>
                    <th class="sorting">订单号</th>
                    <th class="sorting">下单时间</th>
                    <th class="sorting">支付方式</th>
                    <th class="sorting">订单状态</th>
                    <th class="sorting">物流状态</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$order_info->order_id}}</td>
                        <td>{{$order_info->order_price}}</td>
                        <td>{{$order_info->order_sn}}</td>
                        <td>{{date('Y-m-d H:i:s',$order_info->add_time)}}</td>
                        <td>{{$order_info->pay_name}}</td>
                        <td>@if($order_info->order_status==1)
                                已支付
                            @elseif($order_info->order_status==2)
                                已取消
                            @elseif($order_info->order_status==4)
                                退货
                            @elseif($order_info->order_statua==0)
                                正在付款
                            @endif
                        </td>
                        <td>
                            @if($order_info->shipping_status==0)
                                未发货
                            @elseif($order_info->shipping_status==1)
                                已发货
                            @elseif($order_info->shipping_status==2)
                                已收货
                            @elseif($order_info->shipping_status==4)
                                退货
                            @endif
                        </td>
                    </tr>
                </tbody>

            </table>
            <!--数据列表/-->
            <table id="dataList" class="table table-bordered table-striped table-hover dataTable">
                <thead>
                <tr>
                    <th class="sorting">商品名称</th>
                    <th class="sorting">商品价格</th>
                    <th class="sorting">购买数量</th>
                    <th class="sorting">规格</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    @foreach($order_goods_info as $v)
                    <td>{{$v->goods_name}}</td>
                    <td>{{$v->goods_price}}</td>
                    <td>{{$v->buy_number}}</td>
                    <td>
                        @if($v->specs)
                            @foreach($v->specs as $vv)
                                {{$vv['specs_name']}}:{{$vv['specs_val']}}，
                            @endforeach
                        @endif
                    </td>
                </tr>
                @endforeach
                </tbody>

            </table>
            <button class="end">返回</button>
        </div>
        <!-- 数据表格 /-->


    </div>
    <!-- /.box-body -->
</div>
<script>
    $(function(){
        $(document).on('click','.end',function(){
            window.location.href="{{url('/saller/order')}}";
        });
    });
</script>
@include('admin.saller.public.foot')