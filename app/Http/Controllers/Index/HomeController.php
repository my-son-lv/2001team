<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Models\GoodsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Models\OrderModel;
class HomeController extends Controller
{
    public function home(){
        $url = "http://www.2001api.com/api/index/user_home";
        $cate = $this->postcurl($url);
        $goods = GoodsModel::limit(4)->get();
        if(isset($_COOKIE["token"])){
            $token = $_COOKIE["token"];
            $user_id = Redis::hget("token",$token);
            $data = OrderModel::leftjoin("order_goods","order_info.order_id","=","order_goods.order_id")->where(["order_info.user_id"=>$user_id])->get();
        }else{
            return json_encode(["code"=>0001,"message"=>"请登录"],JSON_UNESCAPED_UNICODE);
        }
        return view("index.home.home",["cate"=>$cate,"data"=>$data,"goods"=>$goods]);
    }//我的订单

    public function paid(){
        $url = "http://www.2001api.com/api/index/daifukuan";
        $cate = $this->postcurl($url);
        $goods = GoodsModel::limit(4)->get();
        if(isset($_COOKIE["token"])){
            $token = $_COOKIE["token"];
            $user_id = Redis::hget("token",$token);
            $data = OrderModel::leftjoin("order_goods","order_info.order_id","=","order_goods.order_id")->where(["pay_status"=>1])->where(["order_info.user_id"=>$user_id])->get();
        }else{
            return json_encode(["code"=>0001,"message"=>"请登录"],JSON_UNESCAPED_UNICODE);
        }
        return view("index.home.home_paid",["cate"=>$cate,"data"=>$data,"goods"=>$goods]);
    }//待付款

    public function home_send(){
        $url = "http://www.2001api.com/api/index/daifahuo";
        $cate = $this->postcurl($url);
        $goods = GoodsModel::limit(4)->get();

        if(isset($_COOKIE["token"])){
            $token = $_COOKIE["token"];
            $user_id = Redis::hget("token",$token);
            $data = OrderModel::leftjoin("order_goods","order_info.order_id","=","order_goods.order_id")->where(["shipping_status"=>0])->where(["order_info.user_id"=>$user_id])->get();
        }else{
            return json_encode(["code"=>0001,"message"=>"请登录"],JSON_UNESCAPED_UNICODE);
        }
        return view("index.home.home_send",["cate"=>$cate,"data"=>$data,"goods"=>$goods]);
    }//待发货

    public function home_receive(){
        $url = "http://www.2001api.com/api/index/daishouhuo";
        $cate = $this->postcurl($url);
        $goods = GoodsModel::limit(4)->get();
        if(isset($_COOKIE["token"])){
            $token = $_COOKIE["token"];
            $user_id = Redis::hget("token",$token);
            $data = OrderModel::leftjoin("order_goods","order_info.order_id","=","order_goods.order_id")->where(["shipping_status"=>1])->where(["order_info.user_id"=>$user_id])->get();
        }else{
            return json_encode(["code"=>0001,"message"=>"请登录"],JSON_UNESCAPED_UNICODE);
        }
        return view("index.home.home_receive",["cate"=>$cate,"data"=>$data,"goods"=>$goods]);
    }//待收货

    public function home_eva(){
        $url = "http://www.2001api.com/api/index/daipingjia";
        $cate = $this->postcurl($url);
        return view("index.home.home_eva",["cate"=>$cate]);
    }//待评价

    public function home_person(){
        $url = "http://www.2001api.com/api/index/user_home";
        $cate = $this->postcurl($url);
        return view("index.home.home_person",["cate"=>$cate]);
    }//我的收藏

    public function home_foot(){
        $url = "http://www.2001api.com/api/index/user_home";
        $cate = $this->postcurl($url);
        return view("index.home.home_foot",["cate"=>$cate]);
    }//我的足迹

    public function home_info(){
        $url = "http://www.2001api.com/api/index/user_home";
        $cate = $this->postcurl($url);
        return view("index.home.home_info",["cate"=>$cate]);
    }//个人信息

    public function home_address(){
        $url = "http://www.2001api.com/api/index/user_home";
        $cate = $this->postcurl($url);
        return view("index.home.home_info",["cate"=>$cate]);
    }//地址管理

    public function postcurl($url,$postfield=[],$header=[]){
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);//获取url路径
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$postfield);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result,true);
    }
}
