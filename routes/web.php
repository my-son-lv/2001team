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
    后台
    brand品牌、admin管理员、role角色、right权限
 */
Route::prefix('/admin')->group(function(){
    Route::any('/brand','Brand\BrandController@brand');
    Route::any('/brand_do','Brand\BrandController@brand_do');
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
});
