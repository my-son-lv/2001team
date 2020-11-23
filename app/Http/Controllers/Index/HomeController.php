<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $url = "http://www.2001api.com/api/index/user_home";
        $cate = $this->postcurl($url);
        return view("index.home.home",["cate"=>$cate]);
    }//我的订单

    public function paid(){
        $url = "http://www.2001api.com/api/index/daifukuan";
        $cate = $this->postcurl($url);
        return view("index.home.home_paid",["cate"=>$cate]);
    }//待付款

    public function home_send(){
        $url = "http://www.2001api.com/api/index/daifahuo";
        $cate = $this->postcurl($url);
        return view("index.home.home_send",["cate"=>$cate]);
    }//待发货

    public function home_receive(){
        $url = "http://www.2001api.com/api/index/daishouhuo";
        $cate = $this->postcurl($url);
        return view("index.home.home_receive",["cate"=>$cate]);
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
