<?php

namespace App\Http\Controllers\Saller;

use App\Http\Controllers\Controller;
use App\Models\OrderGoodsModel;
use App\Models\OrderModel;
use App\Models\Specsname_Model;
use App\Models\Specsval_Model;
use App\Models\Statistics;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * 商家模块 订单模块
     */
    public function order(){
        $shipping_status = request()->shipping_status;
        $where = [];
        if($shipping_status){
            $where[] = ['shipping_status','=',$shipping_status];
        }
        $saller_id = session('saller_info')->saller_id;
        $order_model = new OrderModel();
        $order_info = $order_model->order_index($saller_id,$where);
//        dd($order_info);
        return view('admin.saller.order',['order_info'=>$order_info,'shipping_status'=>$shipping_status]);
    }
    /**
     * 商家模块 确认收货
     */
    public function shipment(){
        $order_id = request()->order_id;
        $order_model = new OrderModel();
        $str = $order_model->order_shipment($order_id);
        if($str!==false){
            $data = [
                'success'=>true,
                'msg'=>'成功',
                'data'=>[]
            ];
            return json_encode($data,true);
        }
    }
    /**
     * 商家模块 订单详情
     */
    public function content(){
        $order_id = request()->order_id;
        $order_model = new OrderModel();
        $order_goods_model = new OrderGoodsModel();
        $order_info = $order_model->order_first($order_id);
        $order_goods_info = $order_goods_model->order_order_info($order_id);
//        dd($order_goods_info);
        $specs_name_model = new Specsname_Model();
        $specs_val_model = new Specsval_Model();
        foreach($order_goods_info as $k=>$v){
            if($v['specs_id']!==""){
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
        return view('admin.saller.content',['order_goods_info'=>$order_goods_info,'order_info'=>$order_info]);
    }
    /**
     * 商家模块 统计数据
     */
    public function statistics(){
        $saller_id = session('saller_info')->saller_id;
//        dd($saller_id);
        $statistics_model = new Statistics();
        $stat_info = $statistics_model->leftjoin('goods','statistics.goods_id','=','goods.goods_id')
                                    ->select('statistics.*','goods.goods_name','goods.goods_img','goods.goods_price')
                                    ->where('statistics.saller_id',$saller_id)
                                    ->orderBy('statistics.add_number','desc')
                                    ->paginate(5);
//        dd($stat_info);
        return view('admin.saller.statistics',['stat_info'=>$stat_info]);
    }
}
