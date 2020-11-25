<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CateModel;
use App\Models\KillModel;
use Illuminate\Support\Facades\Redis;
class Index_KillController extends Controller
{
    public function index_kill(){
        $url = "http://www.2001api.com/api/api_kill";
        $cate = $this->postcurl($url);
        return view("index.kill",["cate"=>$cate]);
    }
    public function user_kill(){
        if(!isset($_COOKIE['token'])){
            return json_encode(["code"=>0001,"message"=>"请登录"]);
        }else{
            $kill_id = request()->kill_id;
            $kill = KillModel::leftjoin("goods","kill.goods_id","=","goods.goods_id")->where(["kill_id"=>$kill_id])->first()->toArray();
            $token = $_COOKIE['token'];
            $user_id = Redis::Hget("token",$token);
            $user_kill = Redis::setnx("user_kill_".$user_id."_".$kill["goods_id"]);
            if($user_kill){
                return json_encode(["code"=>0001,"message"=>"参与过!"]);
            }else{
                if(Redis::lpop("kill_".$kill["goods_id"])){
                    Redis::lpush("user_kill_goods_".$user_id.$kill["goods_id"],$kill["goods_id"]);
                    return json_encode(["code"=>0000,"message"=>"秒杀成功"]);
                }else{
                    return json_encode(["code"=>0001,"message"=>"库存不足"]);
                }
            }
        }
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
//关闭
        curl_close($ch);
        return json_decode($result,true);
    }
}
