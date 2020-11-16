<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        return view("index.home.home");
    }//我的订单

    public function paid(){
        return view("index.home.home_paid");
    }//待付款

    public function home_send(){
        return view("index.home.home_send");
    }//待发货

    public function home_receive(){
        return view("index.home.home_receive");
    }//待收货

    public function home_eva(){
        return view("index.home.home_eva");
    }//待评价

    public function home_person(){
        return view("index.home.home_person");
    }//我的收藏

    public function home_foot(){
        return view("index.home.home_foot");
    }//我的足迹

    public function home_info(){
        return view("index.home.home_info");
    }//个人信息

    public function home_address(){
        return view("index.home.home_info");
    }//地址管理
}
