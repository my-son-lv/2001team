<?php

namespace App\Http\Controllers\Advert;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdvertModel;
class AdvertController extends Controller
{
    public function advert(){
        $data = AdvertModel::where(["advert_del"=>1])->get();
        return view("admin.adver.admin_advert",["data"=>$data]);
    }

    public function advert_do(){
        $data = request()->all();
        $Advert_Model = new AdvertModel();
        $res = $Advert_Model->advert_store($data);
        if($res==true){
            return json_encode($arr = ["code"=>0000,"msg"=>"广告添加成功!"]);
        }else{
            return json_encode($arr = ["code"=>0001,"msg"=>"广告添加失败!"]);
        }
    }

    public function advert_del(){
        $advert_id = request()->advert_id;
        $Advert_Model = new AdvertModel();
        $res = $Advert_Model->advert_del($advert_id);
        if($res){
            return json_encode($arr = ["code"=>0000]);
        }else{
            return json_encode($arr = ["code"=>0001]);
        }
    }

    public function advert_upd($advert_id){
        $data = AdvertModel::where(["advert_id"=>$advert_id])->first();
        return view("admin.adver.advert_upd",["data"=>$data]);
    }

    public function advert_upd_do(){
        $data = request()->all();
        $Advert_Model = new AdvertModel();
        $res = $Advert_Model->advert_upd($data);
        if($res){
            return json_encode($arr = ["code"=>0000,"message"=>"修改成功"]);
        }else{
            return json_encode($arr = ["code"=>0001,"message"=>"修改失败"]);
        }
    }
}