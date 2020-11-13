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
