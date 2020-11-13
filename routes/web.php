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
Route::prefix('/admin')->group(function(){
    Route::any('/brand','Brand\BrandController@brand');
    Route::any('/brand_do','Brand\BrandController@brand_do');
    Route::any('/admin/index','Admin\AdminController@index');
    Route::any('/admin/store','Admin\AdminController@store');
    Route::any('/admin/edit/{admin_id}','Admin\AdminController@edit');
    Route::any('/admin/upd','Admin\AdminController@upd');
    Route::any('/admin/del','Admin\AdminController@del');
    Route::any('/role/index','Admin\RoleController@index');
});
