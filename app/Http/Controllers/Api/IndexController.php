<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KillModel;
use App\Models\SpecsModel;
use Illuminate\Http\Request;
use App\Models\CateModel;
use App\Models\GoodsModel;
use App\Models\GoodsImgsModel;
use App\Models\Specsname_Model;
use App\Models\Specsval_Model;
class IndexController extends Controller
{
    public function index_show(){
        $cate_cate = CateModel::get();
        $cate = CateModel::where(["pid"=>0])->limit(6)->get();
        $goods_id=request()->goods_id;
//        dd($goods_id);
        $goodsimg=GoodsImgsModel::where("goods_id",$goods_id)->get();

//        dd($goodsimg);
        $goods=GoodsModel::where("goods_id",$goods_id)->first();

       //规格
        $specs_model = new Specsname_Model();
        $specs_val_model = new Specsval_Model();
        $specs_info = $specs_model->get();
        $specs_val_info = $specs_val_model->get();
        $data = ['goods'=>$goods,'cate'=>$cate,'cate_cate'=>$cate_cate,'goodsimg'=>$goodsimg,'specs_info'=>$specs_info,'specs_val_info'=>$specs_val_info];
        return $data;

    }

    public function api_kill(){
        $cate = CateModel::where(["pid"=>0])->limit(6)->get();
        $kill = KillModel::leftjoin("goods","kill.goods_id","=","goods.goods_id")->get();
        $data = ["cate"=>$cate,"kill"=>$kill];
        return $data;
    }

    public function home(){
        $cate_cate = CateModel::get();
        $cate = CateModel::where(["pid"=>0])->limit(6)->get();
        $data = GoodsModel::where(["goods_status"=>1,"is_del"=>1,"is_shelf"=>1])->get()->toArray();
        $info = $this->GetIndo($cate_cate);
        $data = ["cate"=>$cate,"data"=>$data,"info"=>$info];
        return $data;
    }

    public function GetIndo($cate_cate,$pid=0){
        $info = [];
        foreach($cate_cate as $k=>$v){
            if($pid==$v->pid){
                $info[$k] = $v;
                $info[$k]["son"] = $this->GetIndo($cate_cate,$v->cate_id);
            }
        }
        return $info;
    }
}
