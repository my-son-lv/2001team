<?php

namespace App\Http\Controllers\Coupon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CouponModel;
use App\Models\GoodsModel;
class CouponController extends Controller
{
    public  function  create(){
        $coupon_name=request()->coupon_name;
        $goods=GoodsModel::where('is_shelf',1)->get();
        $where=[];
        if($coupon_name){
            $where[]=['coupon_name','like',"%$coupon_name%"];
        }
        $res=CouponModel::where($where)->paginate(4);
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

    public  function  upd(){
        $coupon_id=request()->coupon_id;
        $coupon=CouponModel::where('coupon_id',$coupon_id)->first();
        $goods=GoodsModel::where('is_shelf',1)->get();
//        dd($goods);
        return view("/admin/coupon/update",['coupon'=>$coupon,'goods'=>$goods]);
    }

    public  function  update_do(){
        $data=request()->all();
        $res=CouponModel::where('coupon_id',$data['coupon_id'])->update($data);
        if($res){
            return json_encode(['code'=>'0000','msg'=>"修改成功",'url'=>"/admin/coupon/create"]);
        }else{
            return json_encode(['code'=>'0001','msg'=>"修改失败",'url'=>"/admin/coupon/create"]);

        }
    }

}
