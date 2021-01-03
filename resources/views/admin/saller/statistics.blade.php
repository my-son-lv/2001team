@include('admin.saller.public.top')
@include('admin.saller.public.left')
        <!-- 内容区域 -->
<div class="content-wrapper">
    <div class="box-header with-border">
        <h3 class="box-title">浏览管理</h3>
    </div>

    <div class="box-body">

        <!-- 数据表格 -->
        <div class="table-box">

            <!--工具栏-->
            <div class="pull-left">
                <div class="form-group form-inline">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default" title="刷新" onclick="window.location.reload();"><i class="fa fa-refresh"></i> 刷新</button>
                    </div>
                </div>
            </div>
            <!--工具栏/-->

            <!--数据列表-->
            <table id="dataList" class="table table-bordered table-striped table-hover dataTable">
                <thead>
                <tr>
                    <th class="sorting_asc">商品名称</th>
                    <th class="sorting">商品图片</th>
                    <th class="sorting">商品价格</th>
                    <th class="sorting">浏览次数</th>
                    <th class="sorting">最近浏览时间</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($stat_info as $v)
                        <tr>
                            <td>{{$v->goods_name}}</td>
                            <td><img src="{{env('JUSTME_URL')}}{{$v->goods_img}}" alt="" width="50px" height="50px"></td>
                            <td>{{$v->goods_price}}</td>
                            <td>{{$v->add_number}}</td>
                            <td>{{date('Y-m-d H:i:s',$v->add_time)}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$stat_info->links()}}
            <!--数据列表/-->
        </div>
        <!-- 数据表格 /-->
    </div>
    <!-- /.box-body -->
</div>
@include('admin.saller.public.foot')