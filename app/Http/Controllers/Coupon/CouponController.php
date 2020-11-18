<?php

namespace App\Http\Controllers\Coupon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CouponModel;
use App\Models\GoodsModel;
class CouponController extends Controller
{
    public  function  create(){
        $goods=GoodsModel::where('is_shelf',1)->get();
        $res=CouponModel::get();
        return view("/admin/coupon/create",['goods'=>$goods,'res'=>$res]);
    }

    public  function  store(){
        $data=request()->all();
        $data['start_time'] = strtotime($data['start_time']);
        $data['end_time'] = strtotime($data['end_time']);
        $res=CouponModel::insert($data);
        if($res){
            return json_encode(['code'=>0000,'message'=>"添加成功"]);
        }
    }

    public  function  del(){
        $coupon_id=request()->coupon_id;
        $res=CouponModel::where("coupon_id",$coupon_id)->delete();
        if($res){
            return json_encode(['code'=>0000,'msg'=>"删除成功",'url'=>"/admin/coupon/create"]);
        }
    }

}
