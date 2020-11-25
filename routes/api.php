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
    Route::any('/regstore', 'Index\LoginController@regstore'); //注册接口
    Route::any('/sendcode', 'Index\LoginController@sendcode'); //发送短信验证码
    Route::any('/api_kill', 'Api\IndexController@api_kill'); //秒杀数据
    Route::any('/index/user_home', 'Api\IndexController@user_home'); //个人中心
    Route::any('/index/daifukuan', 'Api\IndexController@daifukuan'); //待付款
    Route::any('/index/daifahuo', 'Api\IndexController@daifahuo'); //代发货
    Route::any('/index/daishouhuo', 'Api\IndexController@daishouhuo'); //待收货
    Route::any('/index/daipingjia', 'Api\IndexController@daipingjia'); //待收货
    Route::any('/logstore', 'Api\LoginController@logstore'); //登录接口
    Route::post('/index/index_show','Api\IndexController@index_show');//详情
    Route::post('/home','Api\IndexController@home');//详情
    Route::post('/index/addcart','Api\IndexController@addcart');//加入购物车
    Route::post('/index/cart','Api\IndexController@cart');//购物车列表
    Route::post('/index/settl','Api\IndexController@settl');//结算 收货地址
    Route::post('/index/getorder','Api\IndexController@getorder');//结算 收货地址
});

