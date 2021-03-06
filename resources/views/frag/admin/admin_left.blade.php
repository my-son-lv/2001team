<!-- 导航侧栏 -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/status/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p> 测试用户</p>
                <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>
            </div>
        </div>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu"  >
            <li class="header">菜单</li>
            <li id="admin-index"><a href="/admin/"><i class="fa fa-dashboard"></i> <span>首页</span></a></li>

            <!-- 菜单 -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i>
                    <span>后台管理</span>
				            <span class="pull-right-container">
				       			<i class="fa fa-angle-left pull-right"></i>
				   		 	</span>
                </a>
                <ul class="treeview-menu">
                    <li id="admin-login">
                        <a href="/admin/examine" >
                            <i class="fa fa-circle-o"></i>商品审核
                        </a>
                    </li>
                    <li id="admin-login">
                        <a href="/admin/brand" >
                            <i class="fa fa-circle-o"></i>品牌管理
                        </a>
                    </li>
                    <li id="admin-login">
                        <a href="/admin/specs" target="iframe">
                            <i class="fa fa-circle-o"></i>规格管理
                        </a>
                    </li>
                    <li id="admin-login">
                        <a href="{{url('/admin/cate/create')}}" target="iframe">
                            <i class="fa fa-circle-o"></i>分类管理
                        </a>
                    </li>
                    <li id="admin-login">
                        <a href="{{url('/admin/create')}}" >
                            <i class="fa fa-circle-o"></i>快报管理
                        </a>
                    </li>


                    <li id="admin-login">
                        <a href="{{url('/admin/coupon/create')}}" >
                            <i class="fa fa-circle-o"></i>优惠券管理
                        </a>
                    </li>
                </ul>
            </li>
            {{--广告--}}
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i>
                    <span>广告管理</span>
				            <span class="pull-right-container">
				       			<i class="fa fa-angle-left pull-right"></i>
                            </span>
                </a>
                <ul class="treeview-menu">

                    <li id="admin-login">
                        <a href="/admin/position">
                            <i class="fa fa-circle-o"></i>广告位置
                        </a>
                    </li>
                    <li id="admin-login">
                        <a href="/admin/advert" target="iframe">
                            <i class="fa fa-circle-o"></i>广告管理
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i>
                    <span>促销</span>
				            <span class="pull-right-container">
				       			<i class="fa fa-angle-left pull-right"></i>
				   		 	</span>
                </a>
                <ul class="treeview-menu">
                    <li id="admin-login">
                        <a href="/admin/kill">
                            <i class="fa fa-circle-o"></i>秒杀
                        </a>
                        <a href="/admin/barg">
                            <i class="fa fa-circle-o"></i>砍价
                        </a>
                    </li>
                </ul>
            </li>
            {{--商家--}}
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i>
                    <span>商家管理</span>
				            <span class="pull-right-container">
				       			<i class="fa fa-angle-left pull-right"></i>
				   		 	</span>
                </a>
                <ul class="treeview-menu">

                    <li id="admin-login">
                        <a href="/admin/saller_exam" >
                            <i class="fa fa-circle-o"></i>商家审核
                        </a>
                    </li>
                    <li id="admin-login">
                        <a href="/admin/saller" >
                            <i class="fa fa-circle-o"></i>商家管理
                        </a>
                    </li>
                </ul>
            </li>
            {{--权限--}}
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i>
                    <span>控制管理</span>
				            <span class="pull-right-container">
				       			<i class="fa fa-angle-left pull-right"></i>
				   		 	</span>
                </a>
                <ul class="treeview-menu">
                    <li id="admin-login">
                        <a href="{{url('admin/admin/index')}}">
                            <i class="fa fa-circle-o"></i>管理员管理
                        </a>
                    </li>
                    <li id="admin-login">
                        <a href="{{url('admin/role/index')}}">
                            <i class="fa fa-circle-o"></i>角色管理
                        </a>
                    </li>
                    <li id="admin-login">
                        <a href="{{url('admin/right/index')}}">
                            <i class="fa fa-circle-o"></i>权限管理
                        </a>
                    </li>
                    <li id="admin-login">
                        <a href="{{url('admin/admin_role/index')}}" >
                            <i class="fa fa-circle-o"></i>用户角色管理
                        </a>
                    </li>
                    <li id="admin-login">
                        <a href="{{url('admin/role_right/index')}}" >
                            <i class="fa fa-circle-o"></i>角色权限管理
                        </a>
                    </li>
                </ul>
            </li>
            {{--商品--}}
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i>
                    <span>商品管理</span>
				        <span class="pull-right-container">
				       		<i class="fa fa-angle-left pull-right"></i>
				   		</span>
                </a>
                <ul class="treeview-menu">

                    <li id="admin-login">
                        <a href="/admin/goods/create" >
                            <i class="fa fa-circle-o"></i>商品添加
                        </a>
                    </li>
                    <li id="admin-login">
                        <a href="/admin/goods" >
                            <i class="fa fa-circle-o"></i>商品展示
                        </a>
                    </li>
                </ul>
            </li>
            {{--订单--}}
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i>
                    <span>订单管理</span>
				        <span class="pull-right-container">
				       		<i class="fa fa-angle-left pull-right"></i>
				   		</span>
                </a>
                <ul class="treeview-menu">

                    <li id="admin-login">
                        <a href="/admin/saller/order" >
                            <i class="fa fa-circle-o"></i>订单
                        </a>
                    </li>
                    {{--<li id="admin-login">--}}
                        {{--<a href="/admin/goods" >--}}
                            {{--<i class="fa fa-circle-o"></i>商品展示--}}
                        {{--</a>--}}
                    {{--</li>--}}
                </ul>
            </li>
            </ul>
            <!-- 菜单 /-->
    </section>
    <!-- /.sidebar -->
</aside>
<!-- 导航侧栏 /-->
