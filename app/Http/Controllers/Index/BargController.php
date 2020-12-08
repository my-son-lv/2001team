<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BargModel;
use App\Models\Barg_userModel;
use Illuminate\Support\Facades\Redis;
class BargController extends Controller
{
    public function brag_show(){
        $url = "http://www.2001api.com/api/cut_show";
        $cate = $this->postcurl($url);
        $barg_id = request()->barg_id;
        $user_id = request()->user_id;
        $barg_goods = BargModel::leftjoin("goods","barg.goods_id","=","goods.goods_id")->where(["barg.barg_id"=>$barg_id])->first()->toArray();
        return view("index.barg_show",["cate"=>$cate,"barg_goods"=>$barg_goods,"user_id"=>$user_id]);
    }

    public function brag_do(){
        if(isset($_COOKIE["token"])){
            $token = $_COOKIE["token"];
            $user_id = Redis::hget("token",$token);
            $barg_id = request()->barg_id;//接受砍价ID
            $res1 = BargModel::where(["barg_id"=>$barg_id])->first();
            if($res1->cut_number==0){
                return json_encode(["code"=>0001,"message"=>"库存不足"]);
            }else{
                if(empty($barg_id)){//判断传过来的砍价ID是否存在
                    return json_encode(["code"=>0001,"message"=>"系统错误"]);
                }else{
                    $res = BargModel::where(["barg_id"=>$barg_id])->decrement("cut_number");
                    if($res){
                        $urls = "http://www.2001.com/index/brag_show?barg_id=".$barg_id."&cut_price=".$res1->cut_price."&user_id=".$user_id;
                        return json_encode(["code"=>0000,"message"=>"砍价生成成功","user_id"=>$user_id,"urls"=>$urls]);
                    }
                }
            }
        }else{
            return json_encode(["code"=>0002,"message"=>"您还没有登录，是否前往登录"]);
        }
//----------------------------------------------------------------------------------------------------------------------
    }

    public function user_brag_do(){
        $user_id = request()->user_id;
        $barg_id = request()->barg_id;
        $data = [];
        Barg_userModel::insert($data);
    }






































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

        $result = json_decode($result,true);
//关闭
        curl_close($ch);
        return $result;
    }
}
