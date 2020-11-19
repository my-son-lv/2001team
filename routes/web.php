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


/**
    后台首页
 */

Route::any('/admin','Admin\AdminController@home')->middleware("login");
Route::any('/admin_login','Admin\AdminController@admin_login');
Route::any('/admin_login_do','Admin\AdminController@admin_login_do');

/**
    后台
    brand品牌、admin管理员、role角色、right权限
 */
Route::prefix('/admin')->group(function(){
    Route::any('/kill','Kill\KillController@kill')->middleware("login");//后台促销秒杀
    Route::any('/position','Advert\AdvertController@position')->middleware("login");//后台广告位置
    Route::any('/position_do','Advert\AdvertController@position_do')->middleware("login");//后台广告位置添加
    Route::any('/position_advert/{position_id}','Advert\AdvertController@position_advert')->middleware("login");//后台广告位置生成广告
    Route::any('/position_advert_do','Advert\AdvertController@position_advert_do')->middleware("login");//后台广告位置生成广告执行

    Route::any('/admin/index','Admin\AdminController@index')->middleware("login");
    Route::any('/admin/store','Admin\AdminController@store')->middleware("login");
    Route::any('/admin/edit/{admin_id}','Admin\AdminController@edit')->middleware("login");
    Route::any('/admin/upd','Admin\AdminController@upd')->middleware("login");
    Route::any('/admin/del','Admin\AdminController@del')->middleware("login");
    Route::any('/admin/role/{admin_id}','Admin\AdminController@role')->middleware("login");
    Route::any('/admin/rolestore','Admin\AdminController@rolestore')->middleware("login");

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

    //后台 规格添加
    Route::any('specs','Specs\SpecsController@specs')->middleware("login");
    Route::any('specs/create','Specs\SpecsController@specs_create')->middleware("login");
    Route::any('specs/upd','Specs\SpecsController@specs_upd')->middleware("login");

    //后台商品添加
    Route::any('goods/create','Goods\GoodsController@create')->middleware("login");
    Route::any('goods/store','Goods\GoodsController@store')->middleware("login");
    Route::any('goods','Goods\GoodsController@goods')->middleware("login");

    #优惠券管理
    Route::any('/coupon/create','Coupon\CouponController@create')->middleware("login");
    Route::any('/coupon/store','Coupon\CouponController@store')->middleware("login");
    Route::any('/coupon/del','Coupon\CouponController@del')->middleware("login");

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

//后台 规格添加
Route::any('/admin/specs','Specs\SpecsController@specs')->middleware("login");
Route::any('/admin/specs/create','Specs\SpecsController@specs_create')->middleware("login");
Route::any('/admin/specs/upd','Specs\SpecsController@specs_upd')->middleware("login");

//后台商品添加
Route::any('/admin/goods/create','Goods\GoodsController@create')->middleware("login");
Route::any('/admin/goods/upload','Goods\GoodsController@upload')->middleware("login");
Route::any('/admin/goods/uploads','Goods\GoodsController@uploads')->middleware("login");
Route::any('/admin/goods','Goods\GoodsController@goods')->middleware("login");
Route::any('/admin/goods/specs','Goods\GoodsController@specs')->middleware("login");
Route::any('/admin/goods/specs_create','Goods\GoodsController@specs_create')->middleware("login");
/**
    前台
 */
Route::any('/','Index\IndexController@index');//首页
Route::any('/login','Index\loginController@login');//登录
Route::any('/reg','Index\loginController@reg');//注册
Route::any('/index/index_list','Index\IndexController@index_list');//列表
Route::any('/index/index_show','Index\IndexController@index_show');//详情


Route::any('/index/cart','Index\CartController@cart');//购物车
Route::any('/index/order','Index\CartController@order');//订单
Route::any('/index/settl','Index\CartController@settl');//结算页




Route::any('/index/home','Index\HomeController@home');//个人中心
Route::any('/index/home_paid','Index\HomeController@paid');//待付款
Route::any('/index/home_send','Index\HomeController@home_send');//待发货
Route::any('/index/home_receive','Index\HomeController@home_receive');//待收货
Route::any('/index/home_eva','Index\HomeController@home_eva');//待评价
Route::any('/index/home_person','Index\HomeController@home_person');//我的收藏
Route::any('/index/home_foot','Index\HomeController@home_foot');//我的足迹
Route::any('/index/home_info','Index\HomeController@home_info');//个人信息
Route::any('/index/home_address','Index\HomeController@home_address');//地址管理

