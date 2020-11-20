<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SpecsModel;
use Illuminate\Http\Request;
use App\Models\CateModel;
use App\Models\GoodsModel;
use App\Models\GoodsImgsModel;
use App\Models\Specsname_Model;
use App\Models\Specsval_Model;
use App\Models\CartModel;
use App\Models\AddressModel;
class IndexController extends Controller
{
    //商品详情
    public function index_show(){
        $cate_cate = CateModel::get();
        $cate = CateModel::where(["pid"=>0])->limit(6)->get();
        $goods_id=request()->goods_id;
//        dd($goods_id);
        $goodsimg=GoodsImgsModel::where("goods_id",$goods_id)->get();

//        dd($goodsimg);
        $goods=GoodsModel::where("goods_id",$goods_id)->first();

       //规格
        $specs_model = new Specsname_Model();
        $specs_val_model = new Specsval_Model();
        $specs_info = $specs_model->get();
        $specs_val_info = $specs_val_model->get();
        $data = ['goods'=>$goods,'cate'=>$cate,'cate_cate'=>$cate_cate,'goodsimg'=>$goodsimg,'specs_info'=>$specs_info,'specs_val_info'=>$specs_val_info];
        return $data;

    }
//加入购物车
    public  function  addcart(){
        $uid=1;
        $goods_id = request()->goods_id;
        $goods_number = request()->goods_number;
        $goods_attr_id = request()->goods_attr_id;
        if(!$goods_id || !$goods_number){
            return json_encode(['code'=>'0001','msg'=>"缺少参数"]);
        }
        $goods=GoodsModel::where("goods_id",$goods_id)->first();
        if($goods['is_shelf']!==1){
            return json_encode(['code'=>'0001','msg'=>"商品已下架"]);
        }
        if($goods_attr_id==""){
            $res=GoodsModel::where("goods_id",$goods_id)->first();
            if($res['goods_number']<$goods_number){
                return json_encode(['code'=>'0001','msg'=>"商品库存不足"]);
            }
        }else{
            $specs=SpecsModel::where(['goods_id'=>$goods_id,'specs'=>$goods_attr_id])->first();
            if(!$specs){
                return json_encode(['code'=>'0001','msg'=>"库存不足"]);
            }else{
                if($specs['goods_number']<$goods_number){
                    return json_encode(['code'=>'0001','msg'=>"商品库存不足"]);
                }
            }
        }

        $where1 = [];
        $where1[] = ['user_id','=',$uid];
        $where1[] = ['goods_id','=',$goods_id];
        $where1[] = ['specs_id','=',$goods_attr_id];
//        dd($where1);
        $cart = CartModel::where($where1)->first();
        if($cart){
            if($goods_attr_id){
                //关联
                if($goods_number+$cart->buy_number>$specs['goods_number']){
                    $goods_number=$specs->goods_number;
                }else{
                    $goods_number=$goods_number+$cart->buy_number;
                }

            }else{
                //商品
                if($goods_number+$goods->goods_number>$specs['goods_number']){
                    $goods_number=$goods->goods_numbe;
                }else{
                    $goods_number=$goods_number+$goods->goods_number;
                }
            }
            $res=CartModel::where("cart_id",$cart->cart_id)->update(['buy_number'=>$goods_number]);
        }else{
            $data=[
                'user_id'=>$uid,
                'goods_id'=>$goods_id,
                'buy_number'=>$goods_number,
                'goods_name'=>$goods->goods_name,
                'add_time'=>time(),
                'goods_price'=>$goods->goods_price,
                'specs_id'=>$goods_attr_id??'',
            ];
            $res=CartModel::insert($data);
        }
        if($res){
            return json_encode(['code'=>'0000','msg'=>"加入购物车成功",'url'=>"/index/cart"]);
        }
    }

    //购物车列表
    public  function  cart(){
        $uid=1;
        $cart=CartModel::select('cart.*','goods.goods_img')
            ->leftjoin('goods','goods.goods_id','=','cart.goods_id')
            ->where(['user_id'=>$uid])
            ->get();
        $specs_name_model=new Specsname_Model();
        $specs_val_model=new Specsval_Model();
        $data=[];
        foreach($cart as $k=>$v){
            if($v->specs_id){
                $specs_id=explode(':',$v->specs_id);
                foreach($specs_id as $kk=>$vv){
                    $data[]=explode(',',$vv);
                    foreach($data as $kkk=>$vvv){
                        $data[$kkk]['specs_id']=$vvv[0];
                        $data[$kkk]['specs_name']=$specs_name_model->where('specs_id',$vvv[0])->value('specs_name');
                        $data[$kkk]['specs_val_id']=$vvv[1];
                        $data[$kkk]['specs_val']=$specs_val_model->where('id',$vvv[1])->value('specs_val');
                    }
                    $cart[$k]['specs']=$data;
                }
            }
        }
//        dd($cart);
        return json_encode($cart,true);
    }

    #结算
    public  function  settl(){

    }

}
