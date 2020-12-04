<?php

namespace App\Http\Controllers\Advert;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdvertModel;
use App\Models\PositionModel;
class AdvertController extends Controller
{
    public function advert(){
        $data = AdvertModel::where(["advert_del"=>1])->paginate(2);
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

    public function position(){
        $data = PositionModel::where(["position_del"=>1])->paginate(2);
        return view("admin.adver.position",["data"=>$data]);
    }

    public function position_do(){
        $data = request()->all();
        $PositionModel = new PositionModel();
        $res = $PositionModel->position_add($data);
        if($res==true){
            return json_encode($arr = ["code"=>0000,"message"=>"广告位置添加成功"]);
        }else{
            return json_encode($arr = ["code"=>0001,"message"=>"广告位置添加失败"]);
        }
    }

    public function position_advert($position_id){
        $data = PositionModel::where(["position_id"=>$position_id])->first()->toArray();
        $advert = AdvertModel::where(["advert_del"=>1])->get();
        return view("admin.adver.position_advert",["data"=>$data,"advert"=>$advert]);
    }

    public function position_advert_do(){
        $advert_logo = request()->advert_logo;
        $position_id = request()->position_id;
        $res = PositionModel::where(["position_id"=>$position_id])->first()->toArray();
        $width = $res["position_width"];
        $height = $res["position_height"];
        $path = resource_path()."/views/"."advert/";
        if($res["position_type"]==1){
            if(file_exists($path.$position_id."_1.blade.php")){
                $data = "<img src='{{env(\"JUSTME_URL\")}}$advert_logo' style='width: $width;height: $height'>";
                $res = file_put_contents($path.$position_id."_1.blade.php",$data);
                if($res){
                    return json_encode($arr = ["code"=>0000,"message"=>"单图广告替换成功"]);
                }else{
                    return json_encode($arr = ["code"=>0001,"message"=>"单图广告替换失败"]);
                }
            }else{
                $data = "<img src='{{env(\"JUSTME_URL\")}}$advert_logo' style='width: $width;height: $height'>";
                $res = file_put_contents($path.$position_id."_1.blade.php",$data);
                if($res){
                    return json_encode($arr = ["code"=>0000,"message"=>"单图广告生成成功"]);
                }else{
                    return json_encode($arr = ["code"=>0001,"message"=>"单图广告生成失败"]);
                }
            }
        }else{
            echo "文字";
        }
    }
}