<?php

namespace App\Http\Controllers\Saller;

use App\Http\Controllers\Controller;
use App\Models\OrderGoodsModel;
use App\Models\OrderModel;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * 商家模块 订单模块
     */
    public function order(){
        $saller_id = session('saller_info')->saller_id;
        $order_model = new OrderModel();
        $order_info = $order_model->order_index($saller_id);
//        dd($order_info);
        return view('admin.saller.order',['order_info'=>$order_info]);
    }
}
