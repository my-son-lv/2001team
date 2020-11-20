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
                        <a href="#home" data-toggle="tab">修改密码</a>
                    </li>
                </ul>
                <!--tab头/-->

                <!--tab内容-->
                <div class="tab-content">

                    <!--表单内容-->
                    <div class="tab-pane active" id="home">
                        <div class="row data-type">

                            <div class="col-md-2 title">原密码</div>
                            <div class="col-md-10 data">
                                <input type="text" class="form-control"  placeholder="原密码" value="">
                            </div>

                            <div class="col-md-2 title">新密码</div>
                            <div class="col-md-10 data">
                                <input type="text" class="form-control"  placeholder="新密码" value="">
                            </div>

                            <div class="col-md-2 title">确认新密码</div>
                            <div class="col-md-10 data">
                                <input type="text" class="form-control"   placeholder="确认新密码" value="">
                            </div>
                        </div>
                    </div>

                </div>
                <!--tab内容/-->
                <!--表单内容/-->

            </div>




        </div>
        <div class="btn-toolbar list-toolbar">
            <button class="btn btn-primary"><i class="fa fa-save"></i>保存</button>
            <a data-toggle="modal" class="btn btn-danger">提交</a>
        </div>

    </section>
    <!-- 正文区域 /-->
</div>
<!-- 内容区域 /-->
@include('admin.saller.public.foot')