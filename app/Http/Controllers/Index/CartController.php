<?php

namespace App\Http\Controllers\Index;
use App\Http\Controllers\Controller;
use App\Models\AddressModel;
use App\Models\CartModel;
use App\Models\GoodsModel;
use App\Models\OrderModel;
use App\Models\SpecsModel;
use Illuminate\Http\Request;
use DB;
class CartController extends Controller
{
    public function  addcart(){
        $goods_id = request()->goods_id;
        $goods_number = request()->goods_number;
        $goods_attr_id = request()->goods_attr_id;
        $url=env('API_URL')."api/index/addcart";
        $cart=$this->postcurl($url,['goods_id'=>$goods_id,'goods_number'=>$goods_number,'goods_attr_id'=>$goods_attr_id]);
        return json_encode($cart);
    }

    //购物车列表
    public function cart(){
        $uid=1;
        $url=env('API_URL')."api/index/cart";
        $cart=$this->postcurl($url,['user_id',$uid]);
        $goods=GoodsModel::where("is_hot",1)->limit(4)->get();
//        dd($cart);
        return view("index.cart.cart",['cart'=>$cart,'goods'=>$goods]);
    }
    //结算页
    public function settl(){
        $uid=1;
        $cart_id=request()->cart_id;
        $url=env('API_URL')."api/index/settl";
        $cart=$this->postcurl($url,['user_id'=>$uid,'cart_id'=>$cart_id]);
        return view("index.cart.settl",['cart'=>$cart['data']['address'],'cartinfo'=>$cart['data']['cartinfo'],'total'=>$cart['data']['total']]);
    }
        //收货地址添加
    public  function  getorder(){
        $uid=1;
        $data=request()->all();
        $data['user_id']=$uid;
        $url=env('API_URL')."api/index/getorder";
        $cart=$this->postcurl($url,$data);
        return json_encode($cart,true);
    }

    #+
    public  function  getTypePrice(){
        $type=request()->type;
        $cart_id=request()->cart_id;
        $buy_number=request()->buy_number;
        $cart=CartModel::select('specs_id','buy_number','goods_id')->where('cart_id',$cart_id)->first();
        if($type=='+'){
            if($cart->specs_id){
                $specs_number=SpecsModel::select('goods_number')->where(['goods_id'=>$cart['goods_id'],'specs'=>$cart['specs_id']])->first();
                if($buy_number>=$specs_number['goods_number']){
                    $buy_number=$specs_number['goods_number'];
                }else{
                    $buy_number=$buy_number+1;
                }
                return $this->getNumberPrice($cart_id,$buy_number);
            }else{
                $goods_number=GoodsModel::select('goods_number')->where(['goods_id'=>$cart['goods_id']])->first();
                if($buy_number>=$goods_number['goods_number']){
                    $buy_number=$goods_number['goods_number'];
                }else{
                    $buy_number=$goods_number+1;
                }
                return $this->getNumberPrice($cart_id,$buy_number);

            }
        }

    }


    //-
    public  function  getTypePrices(){
        $type=request()->type;
        $cart_id=request()->cart_id;
        $buy_number=request()->buy_number;
        $cart=CartModel::select('specs_id','buy_number','goods_id')->where('cart_id',$cart_id)->first();
        if($cart->specs_id){
            $specs_number=SpecsModel::select('goods_number')->where(['goods_id'=>$cart['goods_id'],'specs'=>$cart['specs_id']])->first();
            if($buy_number>1){
                $buy_number=$buy_number-1;
            }else{
                $buy_number=1;
            }
            return $this->getNumberPrice($cart_id,$buy_number);
        }else{
            $goods_number=GoodsModel::select('goods_number')->where(['goods_id'=>$cart['goods_id']])->first();
            if($buy_number>1){
                $buy_number=$buy_number-1;
            }else{
                $buy_number=1;
            }
            return $this->getNumberPrice($cart_id,$buy_number);
        }
    }

    //文本框
    public  function  getInputPrice(){
        $buy_number=request()->buy_number;
        $cart_id=request()->cart_id;
        if(!preg_match("/^[1-9][0-9]*$/",$buy_number)){
            return json_encode(['code'=>'0001','msg'=>"参数错误"]);
        }
        if(!$cart_id){
            return json_encode(['code'=>'0001','msg'=>"参数错误"]);
        }
        return $this->getNumberPrice($cart_id,$buy_number);

    }

    //单删
    public  function  del(){
        $cart_id=request()->cart_id;
        $cart=CartModel::where("cart_id",$cart_id)->delete();
        if($cart){
            return json_encode(['code'=>'0000',"msg"=>"删除成功"]);
        }
    }
    //复选框
    public  function  manydel(){
        $cart_id = request()->cart_id;
        if(!count($cart_id)){
            return json_encode(['code'=>"0000",'msg'=>'ok','total'=>'0']);
        }
        $cart=CartModel::getprice($cart_id);
        if($cart){
            return json_encode(['code'=>"0000",'msg'=>'ok','total'=>$cart[0]]);
        }else{
            return json_encode(['code'=>"0000",'msg'=>'ok','total'=>'0']);
        }
    }

    public function getNumberPrice($cart_id,$buy_number){
        $res = CartModel::where('cart_id',$cart_id)->update(['buy_number'=>$buy_number]);
        if($res!==false){
            $cart = DB::select("select buy_number*goods_price as total from cart where cart_id in ($cart_id)");
            if($cart){
                return json_encode(['code'=>'0000','msg'=>'ok','total'=>$cart[0],'buy_number'=>$buy_number]);
//                return $this->success('ok',['total'=>$cart[0],'number'=>$buy_number]);
            }
        }
    }


    //订单页面
    public function order(){
        $uid=1;
        $data=request()->all();
        $data['user_id']=$uid;
        $pay_name=['2'=>"微信"];
        $data['pay_name']=$pay_name[$data['pay_type']];
        $data['order_sn']=$this->createOrderSn();
        if($data['address_id']){
            $address=AddressModel::where("address_id",$data['address_id'])->first();
            $address=$address ? $address->toArray() : [];
        }
//        $total=CartModel::ger
//        dd($data);
        return view("index.order");
    }

    //随机生成订单号
    public  function  createOrderSn(){

        $order_sn=date('YmdHis').rand(1000,9999);
        if($this->isHaveOrdersn($order_sn)){
            $this->createOrderSn();
        }
        return $order_sn;
    }
    //订单号出现的次数
    public  function  isHaveOrdersn($order_sn){

        return  OrderModel::where('order_sn',$order_sn)->count();
    }


    //API post curl
    public function postcurl($url,$postfield=[],$header=[]){
//初始化
        $ch = curl_init();
//设置
        curl_setopt($ch,CURLOPT_URL,$url);//获取url路径
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$postfield);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
//执行
        $result = curl_exec($ch);
//        echo $result;exit;
        $result = json_decode($result,true);
//关闭
        curl_close($ch);
        return $result;
    }
}
