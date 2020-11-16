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
            <li id="admin-index"><a href="index.html"><i class="fa fa-dashboard"></i> <span>首页</span></a></li>

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
                        <a href="/admin/brand" >
                            <i class="fa fa-circle-o"></i>商品管理
                        </a>
                    </li>
<<<<<<< HEAD
=======

>>>>>>> b6a7113eec1b723d0c8f916cff52aef5b1dc9a1f
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
                        <a href="item_cat.html" >
                            <i class="fa fa-circle-o"></i>分类管理
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
                        <a href="/admin/advert" target="iframe">
                            <i class="fa fa-circle-o"></i>广告管理
                        </a>
                    </li>
                    <li id="admin-login">
                        <a href="content_category.html" target="iframe">
                            <i class="fa fa-circle-o"></i>广告类型管理
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
                        <a href="seller_1.html" >
                            <i class="fa fa-circle-o"></i>商家审核
                        </a>
                    </li>
                    <li id="admin-login">
                        <a href="seller.html" >
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
            </li>
            <!-- 菜单 /-->

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
<!-- 导航侧栏 /-->
