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

    Route::any('/admin','Admin\AdminController@home');
    Route::any('/test','Index\LoginController@test');
   
/**
    后台首页
 */
Route::any('/admin','Admin\AdminController@home');
/**
    后台
    brand品牌、admin管理员、role角色、right权限
 */
Route::prefix('/admin')->group(function(){

    Route::any('/kill','Kill\KillController@kill');//后台促销秒杀
    Route::any('/position','Advert\AdvertController@position');//后台广告位置
    Route::any('/position_do','Advert\AdvertController@position_do');//后台广告位置添加
    Route::any('/position_advert/{position_id}','Advert\AdvertController@position_advert');//后台广告位置生成广告
    Route::any('/position_advert_do','Advert\AdvertController@position_advert_do');//后台广告位置生成广告执行

    Route::any('/admin/index','Admin\AdminController@index');
    Route::any('/admin/store','Admin\AdminController@store');
    Route::any('/admin/edit/{admin_id}','Admin\AdminController@edit');
    Route::any('/admin/upd','Admin\AdminController@upd');
    Route::any('/admin/del','Admin\AdminController@del');
    Route::any('/admin/role/{admin_id}','Admin\AdminController@role');
    Route::any('/admin/rolestore','Admin\AdminController@rolestore');

    Route::any('/role/index','Admin\RoleController@index');
    Route::any('/role/store','Admin\RoleController@store');
    Route::any('/role/edit/{role_id}','Admin\RoleController@edit');
    Route::any('/role/upd','Admin\RoleController@upd');
    Route::any('/role/del','Admin\RoleController@del');
    Route::any('/role/right/{role_id}','Admin\RoleController@right');
    Route::any('/role/rightstore','Admin\RoleController@rightstore');

    Route::any('/right/index','Admin\RightController@index');
    Route::any('/right/store','Admin\RightController@store');
    Route::any('/right/edit/{right_id}','Admin\RightController@edit');
    Route::any('/right/upd','Admin\RightController@upd');
    Route::any('/right/del','Admin\RightController@del');

    Route::any('/admin_role/index','Admin\Admin_roleController@index');
    Route::any('/admin_role/edit/{admin_role_id}','Admin\Admin_roleController@edit');
    Route::any('/admin_role/upd','Admin\Admin_roleController@upd');
    Route::any('/admin_role/del','Admin\Admin_roleController@del');
    
    Route::any('/role_right/index','Admin\Role_rightController@index');
    Route::any('/role_right/edit/{role_right_id}','Admin\Role_rightController@edit');
    Route::any('/role_right/upd','Admin\Role_rightController@upd');
    Route::any('/role_right/del','Admin\Role_rightController@del');

    Route::any('brand', 'Brand\BrandController@brand');
    Route::any('brand/store', 'Brand\BrandController@store');
    Route::any('brand/del', 'Brand\BrandController@del');
    Route::any('brand/upd', 'Brand\BrandController@upd');
    Route::any('brand/update_do', 'Brand\BrandController@update_do');
    


    //后台商品添加
    //后台 规格添加
    Route::any('/admin/specs','Specs\SpecsController@specs');
    Route::any('/admin/specs/create','Specs\SpecsController@specs_create');
    Route::any('/admin/specs/upd','Specs\SpecsController@specs_upd');

    //后台商品添加
    Route::any('/admin/goods/create','Goods\GoodsController@create');
    Route::any('/admin/goods','Goods\GoodsController@goods');

    /**
        
    */
    Route::any('specs','Specs\SpecsController@specs');
    Route::any('specs/create','Specs\SpecsController@specs_create');
    Route::any('specs/upd','Specs\SpecsController@specs_upd');
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
    Route::any('/coupon/create','Coupon\CouponController@create');
    Route::any('/coupon/store','Coupon\CouponController@store');
    Route::any('/coupon/del','Coupon\CouponController@del');

    Route::any('advert','Advert\AdvertController@advert');//后台广告添加
    Route::any('advert_do','Advert\AdvertController@advert_do');//后台广告添加执行
    Route::any('advert_del','Advert\AdvertController@advert_del');//后台广告删除执行
    Route::any('advert_upd/{advert_id}','Advert\AdvertController@advert_upd');//后台广告修改
    Route::any('advert_upd_do','Advert\AdvertController@advert_upd_do');//后台广告修改

});

    #后台快报
Route::prefix("admin")->group(function(){
    Route::any('create', 'Butti\ButtiController@create');
    Route::post('store', 'Butti\ButtiController@store');
    Route::post('del', 'Butti\ButtiController@del');
    Route::get('upd', 'Butti\ButtiController@upd');
    Route::post('update_do', 'Butti\ButtiController@update_do');
});

Route::prefix("admin")->group(function(){
    Route::any('/cate/create', 'Cate\CatrController@create');//分类视图
    Route::any('/cate/store', 'Cate\CatrController@store');#分类添加
    Route::post('/cate/check_cateshows', 'Cate\CatrController@check_cateshows');#√ x
    Route::get('/cate/del','Cate\CatrController@del');#删除
});



/**
    前台
 */
    Route::any('/','Index\IndexController@index');//首页
    Route::any('/login','Index\loginController@login');//登录
    Route::any('/logindo','Index\loginController@logindo');//执行登录
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


});
