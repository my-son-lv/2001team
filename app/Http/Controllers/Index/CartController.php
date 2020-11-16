<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart(){
        return view("index.cart.cart");
    }//购物车列表

    public function settl(){
        return view("index.cart.settl");
    }//结算页

    public function order(){
        return view("index.order");
    }//订单页面
}
