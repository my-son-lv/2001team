<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\OrderGoodsModel;
use App\Models\OrderModel;
use App\Models\Specsname_Model;
use App\Models\Specsval_Model;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * 后台的自营订单管理
     */
    public function order(){
        $shipping_status = request()->shipping_status;
        $where = [];
        if($shipping_status){
            $where[] = ['shipping_status','=',$shipping_status];
        }
        $order_model = new OrderModel();
        $order_info = $order_model->order_index(0,$where);
//        dd($order_info);
        return view('admin.order.order',['order_info'=>$order_info,'shipping_status'=>$shipping_status]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 自营 订单详情
     */
    public function content(){
        $order_id = request()->order_id;
//        dd($order_id);
        $order_model = new OrderModel();
        $order_goods_model = new OrderGoodsModel();
        $order_info = $order_model->order_first($order_id);
        $order_goods_info = $order_goods_model->order_order_info($order_id);
//        dd($order_goods_info);
        $specs_name_model = new Specsname_Model();
        $specs_val_model = new Specsval_Model();
        foreach($order_goods_info as $k=>$v){
            if($v['specs_id']){
//                dd($v['order']);
                $specs = explode(':',$v['specs_id']);
                $res = [];
                foreach($specs as $kk=>$vv){
                    $vv =  explode(',',$vv);
                    $res[] = [
                        'specs_name'=>$specs_name_model->specs_name($vv[0]),
                        'specs_val'=>$specs_val_model->specs_val($vv[1])
                    ];
                }
                $order_goods_info[$k]['specs'] = $res;
            }
        }
//        dd($order_goods_info);
        return view('admin.order.content',['order_goods_info'=>$order_goods_info,'order_info'=>$order_info]);
    }
}
