<?php

namespace App\Http\Controllers\Barg;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GoodsModel;
class BargController extends Controller
{
    public function barg(){
        $goods = GoodsModel::get();
        return view("admin.barg.barg",["goods"=>$goods]);
    }

    public function barg_do(){
        $data = request()->all();
        $goods_first = GoodsModel::where(["goods_id"=>$data["goods_id"]])->first();
        $a = $goods_first->goods_price*0.3;
        dd($a);
        $data["brag_add_time"] = strtotime($data["brag_add_time"]);
        $data["brag_end_time"] = strtotime($data["brag_end_time"]);
        $data["present_price"] =$goods_first->goods_price-$data["cut_price"];//现价
        $data["goods_price"] = $goods_first->goods_price;
        dd($data);
    }
}
