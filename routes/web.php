<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::domain('www.2001team.com')->group(function(){ //域名分组

    /**
        后台首页
    */

Route::any('/admin','Admin\AdminController@home')->middleware("login");
Route::any('/admin_login','Admin\AdminController@admin_login');
Route::any('/admin_login_do','Admin\AdminController@admin_login_do');
Route::any('/test','Index\LoginController@test');
/**
    后台
    brand品牌、admin管理员、role角色、right权限
 */
Route::prefix('/admin')->group(function(){
    Route::any('/kill','Kill\KillController@kill')->middleware("login");//秒杀
    Route::any('/kill_do','Kill\KillController@kill_do')->middleware("login");//秒杀

    Route::any('/role/index','Admin\RoleController@index')->middleware("login");
    Route::any('/role/store','Admin\RoleController@store')->middleware("login");
    Route::any('/role/edit/{role_id}','Admin\RoleController@edit')->middleware("login");
    Route::any('/role/upd','Admin\RoleController@upd')->middleware("login");
    Route::any('/role/del','Admin\RoleController@del')->middleware("login");
    Route::any('/role/right/{role_id}','Admin\RoleController@right')->middleware("login");
    Route::any('/role/rightstore','Admin\RoleController@rightstore')->middleware("login");

    Route::any('/right/index','Admin\RightController@index')->middleware("login");
    Route::any('/right/store','Admin\RightController@store')->middleware("login");
    Route::any('/right/edit/{right_id}','Admin\RightController@edit')->middleware("login");
    Route::any('/right/upd','Admin\RightController@upd')->middleware("login");
    Route::any('/right/del','Admin\RightController@del')->middleware("login");

    Route::any('/admin_role/index','Admin\Admin_roleController@index')->middleware("login");
    Route::any('/admin_role/edit/{admin_role_id}','Admin\Admin_roleController@edit')->middleware("login");
    Route::any('/admin_role/upd','Admin\Admin_roleController@upd')->middleware("login");
    Route::any('/admin_role/del','Admin\Admin_roleController@del')->middleware("login");
    
    Route::any('/role_right/index','Admin\Role_rightController@index')->middleware("login");
    Route::any('/role_right/edit/{role_right_id}','Admin\Role_rightController@edit')->middleware("login");
    Route::any('/role_right/upd','Admin\Role_rightController@upd')->middleware("login");
    Route::any('/role_right/del','Admin\Role_rightController@del')->middleware("login");

    Route::any('brand', 'Brand\BrandController@brand')->middleware("login");
    Route::any('brand/store', 'Brand\BrandController@store')->middleware("login");
    Route::any('brand/del', 'Brand\BrandController@del')->middleware("login");
    Route::any('brand/upd', 'Brand\BrandController@upd')->middleware("login");
    Route::any('brand/update_do', 'Brand\BrandController@update_do')->middleware("login");

    Route::any('advert','Advert\AdvertController@advert')->middleware("login");//后台广告添加
    Route::any('advert_do','Advert\AdvertController@advert_do')->middleware("login");//后台广告添加执行
    Route::any('advert_del','Advert\AdvertController@advert_del')->middleware("login");//后台广告删除执行
    Route::any('advert_upd/{advert_id}','Advert\AdvertController@advert_upd')->middleware("login");//后台广告修改
    Route::any('advert_upd_do','Advert\AdvertController@advert_upd_do')->middleware("login");//后台广告修改

    Route::any('/admin/index','Admin\AdminController@index');
    Route::any('/admin/store','Admin\AdminController@store');
    Route::any('/admin/edit/{admin_id}','Admin\AdminController@edit');
    Route::any('/admin/upd','Admin\AdminController@upd');
    Route::any('/admin/del','Admin\AdminController@del');
    Route::any('/admin/role/{admin_id}','Admin\AdminController@role');
    Route::any('/admin/rolestore','Admin\AdminController@rolestore');

    //后台 规格添加
    Route::any('/specs','Specs\SpecsController@specs');
    Route::any('/specs/create','Specs\SpecsController@specs_create');
    Route::any('/specs/upd','Specs\SpecsController@specs_upd');
//后台商品添加
    Route::any('goods/create','Goods\GoodsController@create');
    Route::any('goods/upload','Goods\GoodsController@upload');
    Route::any('goods/uploads','Goods\GoodsController@uploads');
    Route::any('goods','Goods\GoodsController@goods');
    Route::any('goods/store','Goods\GoodsController@store');//商品添加的方法
    Route::any('goods/specs','Goods\GoodsController@specs');
    Route::any('goods/specs_create','Goods\GoodsController@specs_create');
    Route::any('goods/del','Goods\GoodsController@del');//商品的批量删除
    Route::any('goods/update','Goods\GoodsController@update');//商品的修改页面
    #优惠券管理
    Route::any('/coupon/create','Coupon\CouponController@create')->middleware("login");
    Route::any('/coupon/store','Coupon\CouponController@store')->middleware("login");
    Route::any('/coupon/del','Coupon\CouponController@del')->middleware("login");

    //商品审核 examine
    Route::any('/examine','Examine\ExamineController@examine')->middleware("login");
    Route::any('/examine/exam_true','Examine\ExamineController@exam_true')->middleware("login");
    Route::any('/examine/exam_false','Examine\ExamineController@exam_false')->middleware("login");

    //商家审核
    Route::any('/saller_exam','Examine\ExamineController@saller_exam')->middleware("login");
    Route::any('/saller_examine','Examine\ExamineController@saller_examine')->middleware("login");
    Route::any('/saller_examine/saller_true','Examine\ExamineController@saller_true')->middleware("login");
    Route::any('/saller_examine/saller_false','Examine\ExamineController@saller_false')->middleware("login");
    Route::any('/saller_examine/saller_down','Examine\ExamineController@saller_down')->middleware("login");
    //后台的商家管理
    Route::any('/saller','Examine\ExamineController@saller')->middleware("login");

});




    #后台快报
Route::prefix("admin")->group(function(){
    Route::any('create', 'Butti\ButtiController@create')->middleware("login");
    Route::post('store', 'Butti\ButtiController@store')->middleware("login");
    Route::post('del', 'Butti\ButtiController@del')->middleware("login");
    Route::get('upd', 'Butti\ButtiController@upd')->middleware("login");
    Route::post('update_do', 'Butti\ButtiController@update_do')->middleware("login");
});

Route::prefix("admin")->group(function(){
    Route::any('/cate/create', 'Cate\CatrController@create')->middleware("login");//分类视图
    Route::any('/cate/store', 'Cate\CatrController@store')->middleware("login");#分类添加
    Route::post('/cate/check_cateshows', 'Cate\CatrController@check_cateshows')->middleware("login");#√ x
    Route::get('/cate/del','Cate\CatrController@del')->middleware("login");#删除
});

/**
    前台
 */
    Route::any('/','Index\IndexController@index');//首页
    Route::any('/login','Index\loginController@login');//登录
    Route::any('/logindo','Index\loginController@logindo');//执行登录
    Route::any('/reg','Index\loginController@reg');//注册
    Route::any('/loginout','Index\loginController@loginout');//退出登录
    Route::any('/index/index_list/{cate_id}','Index\IndexController@index_list');//列表
    Route::any('/index/index_show','Index\IndexController@index_show');//详情
    Route::any('/index/addcart','Index\CartController@addcart');//加入购物车
    Route::any('/index/cart','Index\CartController@cart');//购物车列表
    Route::any('/index/index_kill','Index\Index_KillController@index_kill');//秒杀
    Route::any('/user_kill','Index\Index_KillController@user_kill');//用户点击秒杀按钮

// ->middleware('IndexLogin');//购物车->middleware('IndexLogin');//订单->middleware('IndexLogin');//结算页
    Route::any('/index/cart','Index\CartController@cart');//购物车
    Route::any('/index/getTypePrice','Index\CartController@getTypePrice');//购物车 +
    Route::any('/index/getTypePrices','Index\CartController@getTypePrices');//购物车 -
    Route::any('/index/getInputPrice','Index\CartController@getInputPrice');//购物车 文本框
    Route::any('/index/del','Index\CartController@del');//购物车 单删
    Route::any('/index/manydel','Index\CartController@manydel');//购物车 复选框
    Route::any('/index/order','Index\CartController@order');#订单
    Route::any('/index/settl','Index\CartController@settl');#结算
    Route::any('/user_colle','Index\IndexController@user_colle');//用户点击列表收藏

    Route::any('/index/cart','Index\CartController@cart')->middleware('IndexLogin');//购物车
    Route::any('/index/order','Index\CartController@order')->middleware('IndexLogin');//订单
    Route::any('/index/settl','Index\CartController@settl')->middleware('IndexLogin');//结算页

    Route::any('/index/home','Index\HomeController@home')->middleware('IndexLogin');//个人中心
    Route::any('/index/home_paid','Index\HomeController@paid')->middleware('IndexLogin');//待付款
    Route::any('/index/home_send','Index\HomeController@home_send')->middleware('IndexLogin');//待发货
    Route::any('/index/home_receive','Index\HomeController@home_receive')->middleware('IndexLogin');//待收货
    Route::any('/index/home_eva','Index\HomeController@home_eva')->middleware('IndexLogin');//待评价
    Route::any('/index/home_person','Index\HomeController@home_person')->middleware('IndexLogin');//我的收藏
    Route::any('/index/home_foot','Index\HomeController@home_foot')->middleware('IndexLogin');//我的足迹
    Route::any('/index/home_info','Index\HomeController@home_info')->middleware('IndexLogin');//个人信息
    Route::any('/index/home_address','Index\HomeController@home_address')->middleware('IndexLogin');//地址管理
    Route::any('/index/getorder','Index\CartController@getorder')->middleware('IndexLogin');//三级联动
    Route::any('/index/home_address','Index\HomeController@home_address')->middleware('IndexLogin');//地址管理

    Route::any('/index/getorder','Index\CartController@getorder');//收货地址

    /**
     * 商家模块
     */
    Route::any('/saller/login', 'Saller\LoginController@login');//商家登录
    Route::any('/saller/reg', 'Saller\LoginController@reg');//商家入驻
    Route::any('/saller/regdo', 'Saller\LoginController@regdo');//商家入驻方法
    Route::any('/saller/logindo', 'Saller\LoginController@logindo');//商家登录
    Route::prefix("saller")->middleware('CheckSallerLogin')->group(function() {
        Route::any('/', 'Saller\SallerController@index');//商家模块首页
        Route::any('/saller', 'Saller\SallerController@saller');//商家模块商家信息
        Route::any('/sallerdo', 'Saller\SallerController@sallerdo');//商家模块修改商家信息
        Route::any('/update_pwd', 'Saller\SallerController@update_pwd');//商家模块商家修改密码
        Route::any('/goods/create', 'Saller\GoodsController@create');//商家模块 添加商品
        Route::any('/goods', 'Saller\GoodsController@goods');//商家模块 商品展示
        Route::any('/goods/upload', 'Saller\GoodsController@upload');//商家模块 上传图片
        Route::any('/goods/uploads', 'Saller\GoodsController@uploads');//商家模块 上传相册
        Route::any('/goods/specs_create', 'Saller\GoodsController@specs_create');//商家模块 sku处理
        Route::any('/goods/specs', 'Saller\GoodsController@specs');//商家模块 规格添加
        Route::any('/goods/store', 'Saller\GoodsController@store');//商家模块 商品添加方法
        Route::any('/goods/update', 'Saller\GoodsController@update');//商家模块 修改
        Route::any('/goods/del', 'Saller\GoodsController@del');//商家模块 批量删除
        Route::any('/order', 'Saller\OrderController@order');//商家模块 订单管理
    });

});
