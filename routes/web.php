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

Route::any('/admin','Admin\AdminController@home');

/**
    后台品牌
 */
Route::any('/admin/brand','Brand\BrandController@brand');
Route::any('/admin/brand_do','Brand\BrandController@brand_do');

/**
    后台广告
 */
Route::any('/admin/advert','Advert\AdvertController@advert');//后台广告添加
Route::any('/admin/advert_do','Advert\AdvertController@advert_do');//后台广告添加执行
Route::any('/admin/advert_del','Advert\AdvertController@advert_del');//后台广告删除执行
Route::any('/admin/advert_upd/{advert_id}','Advert\AdvertController@advert_upd');//后台广告修改
Route::any('/admin/advert_upd_do','Advert\AdvertController@advert_upd_do');//后台广告修改

//后台 规格添加
Route::any('/admin/specs','Specs\SpecsController@specs');
Route::any('/admin/specs/create','Specs\SpecsController@specs_create');
Route::any('/admin/specs/upd','Specs\SpecsController@specs_upd');

//后台商品添加
Route::any('/admin/goods/create','Goods\GoodsController@create');
Route::any('/admin/goods','Goods\GoodsController@goods');

//======================================================================================================================
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


