<?php
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

        //域名分组
Route::domain('www.2001api.com')->group(function(){
    Route::post('/index/index_show','Api\IndexController@index_show');//详情
    Route::post('/index/addcart','Api\IndexController@addcart');//加入购物车
    Route::post('/index/cart','Api\IndexController@cart');//购物车列表
    Route::post('/index/settl','Api\IndexController@settl');//结算
    Route::post('/index/getorder','Api\IndexController@getorder');//三级联动
});

