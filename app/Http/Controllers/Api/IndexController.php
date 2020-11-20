<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KillModel;
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
        $uid=1;
        $cart_id=request()->cart_id;
        $cart_id = explode(',',$cart_id);
        $address=AddressModel::where('user_id',$uid)->get();
        $cartinfo=CartModel::select('cart.*','goods.goods_img')
                ->leftjoin('goods','goods.goods_id','=','cart.goods_id')
                ->whereIn('cart_id',$cart_id)
                ->get();
//        dd($cart);
        $specs_name_model=new Specsname_Model();
        $specs_val_model=new Specsval_Model();
        $date=[];
        foreach($cartinfo as $k=>$v){
            if($v->specs_id){
                $specs_id=explode(':',$v->specs_id);
                foreach($specs_id as $kk=>$vv){
                    $date[]=explode(',',$vv);
                    foreach($date as $kkk=>$vvv){
                        $date[$kkk]['specs_id']=$vvv[0];
                        $date[$kkk]['specs_name']=$specs_name_model->where('specs_id',$vvv[0])->value('specs_name');
                        $date[$kkk]['specs_val_id']=$vvv[1];
                        $date[$kkk]['specs_val']=$specs_val_model->where('id',$vvv[1])->value('specs_val');
                    }
                    $cartinfo[$k]['specs']=$date;
                }
            }
        }
        return json_encode(['code'=>'0001','msg'=>"成功",'data'=>['address'=>$address,'cartinfo'=>$cartinfo]]);

    }
    //地址
    public  function  getorder(){
        $uid=1;
        $data=request()->all();
        $res=AddressModel::where('user_id',$uid)->update(['is_moren'=>2]);
        $address=AddressModel::insert($data);

        if($address){
            return json_encode(['code'=>'0000','msg'=>"添加收货地址成功",'data'=>[]]);
        }
    }
//秒杀
    public function api_kill(){
        $cate = CateModel::where(["pid"=>0])->limit(6)->get();
        $kill = KillModel::leftjoin("goods","kill.goods_id","=","goods.goods_id")->get();
        $data = ["cate"=>$cate,"kill"=>$kill];
        return $data;
    }

    public function home(){
        $cate_cate = CateModel::get();
        $cate = CateModel::where(["pid"=>0])->limit(6)->get();
        $data = GoodsModel::where(["goods_status"=>1,"is_del"=>1,"is_shelf"=>1])->get()->toArray();
        $info = $this->GetIndo($cate_cate);
        $data = ["cate"=>$cate,"data"=>$data,"info"=>$info];
        return $data;
    }

    public function GetIndo($cate_cate,$pid=0){
        $info = [];
        foreach($cate_cate as $k=>$v){
            if($pid==$v->pid){
                $info[$k] = $v;
                $info[$k]["son"] = $this->GetIndo($cate_cate,$v->cate_id);
            }
        }
        return $info;
    }
}
