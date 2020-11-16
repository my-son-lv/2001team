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

   # 后台品牌
Route::prefix("admin")->group(function(){
    Route::any('brand', 'Brand\BrandController@brand');
    Route::any('brand/store', 'Brand\BrandController@store');
    Route::any('brand/del', 'Brand\BrandController@del');
    Route::any('brand/upd', 'Brand\BrandController@upd');
    Route::any('brand/update_do', 'Brand\BrandController@update_do');

});

    #后台快报
Route::prefix("admin")->group(function(){
    Route::any('create', 'Butti\ButtiController@create');
    Route::post('store', 'Butti\ButtiController@store');
    Route::post('del', 'Butti\ButtiController@del');
    Route::get('upd', 'Butti\ButtiController@upd');
    Route::post('update_do', 'Butti\ButtiController@update_do');
});

#后台分类
Route::prefix("admin")->group(function(){
    Route::any('/cate/create', 'Cate\CatrController@create');//分类视图
    Route::any('/cate/store', 'Cate\CatrController@store');#分类添加
    Route::post('/cate/check_cateshows', 'Cate\CatrController@check_cateshows');#√ x
    Route::get('/cate/del','Cate\CatrController@del');#删除
});
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
