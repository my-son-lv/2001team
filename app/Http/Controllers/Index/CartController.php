<?php

namespace App\Http\Controllers\Index;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
//        dd($cart);
        return view("index.cart.cart",['cart'=>$cart]);
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




    //订单页面
    public function order(){

        return view("index.order");
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
