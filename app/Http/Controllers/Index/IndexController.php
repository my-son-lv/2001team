<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GoodsModel;
use App\Models\CateModel;
class IndexController extends Controller
{
    public function index(){
        $cate_cate = CateModel::get();
        $cate = CateModel::where(["pid"=>0])->limit(6)->get();
        $data = GoodsModel::where(["goods_status"=>1,"is_del"=>1,"is_shelf"=>1])->get()->toArray();
        $info = $this->GetIndo($cate_cate);
        return view("index.index",["data"=>$data,"cate"=>$cate,"info"=>$info]);
    }//首页

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

    public function index_list(){
        return view("index.index_list");
    }//列表

    public function index_show(){
        return view("index.index_show");
    }//详情
}
