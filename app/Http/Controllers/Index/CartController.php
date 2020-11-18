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
        echo $result;exit;
//关闭
        curl_close($ch);
        return json_decode($result,true);
    }

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
