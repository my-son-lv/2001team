<?php

namespace App\Http\Controllers\Kill;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GoodsModel;
use App\Models\KillModel;
use Illuminate\Support\Facades\Redis;
class KillController extends Controller
{
    public function kill(){
        $goods = GoodsModel::get();
        $kill = KillModel::leftjoin("goods","kill.goods_id","=","goods.goods_id")->where(["kill_del"=>1])->get();
        return view("admin.kill.kill",["goods"=>$goods,"kill"=>$kill]);
    }

    public function kill_do(){
        $data = request()->all();
        $data["goods_add_time"] = strtotime($data["goods_add_time"]);
        $data["goods_end_time"] = strtotime($data["goods_end_time"]);
        $res = KillModel::insert($data);
        if($res){
            for($i=0;$i<$data["goods_numbers"];$i++){
                Redis::lpush("kill_".$data["goods_id"],1);
            }
            return json_encode($arr = ["code"=>0000,"message"=>"秒杀商品添加OK"]);
        }else{
            return json_encode($arr = ["code"=>0001,"message"=>"秒杀商品添加NO"]);
        }
    }
}
