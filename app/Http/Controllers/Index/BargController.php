<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BargModel;
use App\Models\Barg_userModel;
use App\Models\Cut_journalModel;
use Illuminate\Support\Facades\Redis;
class BargController extends Controller
{
    public function brag_show(){
        $arr = [1,85,12,84,65,487,15,123,88888,659,158,1258,21,0,14,32,54,8485];
        $len = count($arr);
        if($len<2){
            return $arr;
        }
        for($i=0;$i<$len;$i++){
            for($j=0;$j<$len;$j++){
                if($arr[$i]>$arr[$j]){
                    $temp = $arr[$i];
                    $arr[$i] = $arr[$j];
                    $arr[$j] = $temp;
                }
            }
        }
        // dd($arr);
        if(!isset($_COOKIE["token"])){
            return redirect("/login");
        }eLse{
            $users_id = Redis::hget("token",$_COOKIE["token"]);
            $data = Barg_userModel::leftjoin("user","barg_user.kan_user_id","=","user.user_id")->where(["barg_user.user_id"=>$users_id])->get();
        }
        $url = "http://www.2001api.com/api/cut_show";
        $cate = $this->postcurl($url);
        $barg_id = request()->barg_id;
        $user_id = request()->user_id;
        $users_journal = Cut_journalModel::where(["user_id"=>$users_id])->first();
        $barg_goods = BargModel::leftjoin("goods","barg.goods_id","=","goods.goods_id")->where(["barg.barg_id"=>$barg_id])->first()->toArray();
        return view("index.barg_show",["cate"=>$cate,"barg_goods"=>$barg_goods,"user_id"=>$user_id,"data"=>$data,"users_journal"=>$users_journal]);
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
                        $cut_journal = [
                            "user_id"=>$user_id,
                            "user_add_time"=>time()+86400,
                        ];
                        if(!Cut_journalModel::where(["user_id"=>$user_id])->first()){
                            Cut_journalModel::insert($cut_journal);
                        }
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
        if (!isset($_COOKIE["token"])){
            return json_encode(["code"=>0002,",message"=>"还没有登录，是否前往登录","url"=>"/login"]);
        }else{
            $kan_user_id = Redis::hget("token",$_COOKIE["token"]);
            $user_id = request()->user_id;
            if(Barg_userModel::where(["kan_user_id"=>$user_id])->first()){
                return json_encode(["code"=>0001,"message"=>"参与过了呢！"]);
            }else{
                $barg_id = request()->barg_id;
                $goods = BargModel::where(["barg_id"=>$barg_id])->first();
                $data = [
                    "barg_id" => $barg_id,
                    "user_id" => $user_id,
                    "add_time" => time(),
                    "barg_user_price" => Redis::lpop("cut_".$goods->goods_id),
                    "kan_user_id" =>$kan_user_id,
                ];
                $res = Barg_userModel::insert($data);
                if($res){
                    return json_encode(["code"=>0000,"message"=>"帮砍成功","url"=>"/index/brag"]);
                }else{
                    return json_encode(["code"=>0001,"message"=>"系统错误"]);
                }
            }
        }
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
