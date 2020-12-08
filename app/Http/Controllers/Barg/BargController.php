<?php

namespace App\Http\Controllers\Barg;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GoodsModel;
use App\Models\BargModel;
use Illuminate\Support\Facades\Redis;
class BargController extends Controller
{
    public function barg(){
        $goods = GoodsModel::get();
        $barg = BargModel::leftjoin("goods","barg.goods_id","=","goods.goods_id")->where(["is_head"=>1])->get();
        return view("admin.barg.barg",["goods"=>$goods,"barg"=>$barg]);
    }

    public function barg_do(){
        $data = request()->all();
        $Barg_Model = new BargModel();
        if(substr($data["cut_people"],-1)!=0){
            return json_encode(["code"=>0001,"message"=>"需砍人数有误"]);
        }
        $goods_first = GoodsModel::where(["goods_id"=>$data["goods_id"]])->first();
//        if(BargModel::where(["goods_id"=>$data["goods_id"],"is_head"=>1])->first()){
//            return json_encode(["code"=>0001,"message"=>"商品重复"]);
//        }
        $nengkan = $data["cut_price"]*0.1;//算出能砍的价格
        $front = $nengkan*0.5;//前段0.5-价钱  50
        $in = $nengkan*0.3;//中段0.3-价钱     30
        $after = $nengkan*0.2;//后段0.2-价钱  20


        $fronts = $data["cut_people"]*0.2;//前端0.2-人数 40
        $ins = $data["cut_people"]*0.3;//前端0.3-人数    60
        $afters = $data["cut_people"]*0.5;//前端0.5-人数 100

//============================================第一阶段==================================================================
        $min_money=0.03;
        $money_right=$front;
        $randMoney=[];
        for($i=1;$i<=$fronts;$i++){
            if($i== $fronts){
                $money=$money_right;
            }else{
                $max=$money_right*$front - ($fronts - $i ) * $min_money *$front;
                $money= rand($min_money*$front,$max) /$front;
                $money=sprintf("%.2f",$money);
            }
            $randMoney[]=$money;
            $money_right=$money_right - $money;
            $money_right=sprintf("%.2f",$money_right);
        }
        shuffle($randMoney);
//=============================================结尾=====================================================================

//===========================================第二阶段===================================================================
        $er_money=0.05;
        $er_right=$in;
        $er_Money=[];
        for($a=1;$a<=$ins;$a++){
            if($a== $ins){
                $er_moneys=$er_right;
            }else{
                $er_max=$er_right*$in - ($ins - $a ) * $er_money *$in;
                $er_moneys= rand($er_money*$in,$er_max) /$in;
                $er_moneys=sprintf("%.2f",$er_moneys);
            }
            $er_Money[]=$er_moneys;
            $er_right=$er_right - $er_moneys;
            $er_right=sprintf("%.2f",$er_right);
        }
        shuffle($er_Money);
//===========================================结尾=======================================================================

        //===================================第三阶段===================================================================
        $san_money=0.1;
        $san_right=$after;
        $san=[];
        for($s=1;$s<=$afters;$s++){
            if($s == $afters){
                $san_Money=$san_right;
            }else{
                $san_max=$san_right*$after - ($afters - $s ) * $san_money *$after;
                $san_Money= rand($san_money*$after,$san_max) /$after;
                $san_Money=sprintf("%.2f",$san_Money);
            }
            $san[]=$san_Money;
            $san_right=$san_right - $san_Money;
            $san_right=sprintf("%.2f",$san_right);
        }
        shuffle($san);
        $zongsu = array_merge($randMoney,$er_Money,$san);
        //===================================结尾=======================================================================
        if($data["cut_number"]>$goods_first["goods_price"]){
            return json_encode(["code"=>0001,"message"=>"上架数量超出范围"]);
        }
        $Barg_Model->goods_id = $data["goods_id"];
        $Barg_Model->brag_add_time = strtotime($data["brag_add_time"]);
        $Barg_Model->brag_end_time = strtotime($data["brag_end_time"]);
        $Barg_Model->cut_price = $data["cut_price"]-$nengkan;
        $Barg_Model->cut_people = $data["cut_people"];
        $Barg_Model->cut_number = $data["cut_number"];
        $Barg_Model->present_price = $data["cut_price"];
        $Barg_Model->cut_shengyu = $nengkan;
        $res = $Barg_Model->save();
        if($res){
            foreach($zongsu as $v){
                Redis::lpush("cut_".$data["goods_id"],$v);
            }
            return json_encode(["code"=>0000,"message"=>"OK"]);
        }else{
            return json_encode(["code"=>0001,"message"=>"NO"]);
        }
    }

    public function barg_lists(){
        return view("admin.barg.barg_lists");
    }
}
