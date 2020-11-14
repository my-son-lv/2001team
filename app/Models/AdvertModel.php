<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvertModel extends Model
{
    protected $table="advert";
    protected $primarKey="advert_id";
    public $timestamps=false;

    public function advert_store($data){
        if (request()->hasFile('advert_logo')){
            $file = request()->file('advert_logo');
            if ($file->isValid()){
                $path = $file->store('images');
            }
        }
        $data["advert_logo"] = $path;
        $data["advert_add_time"] = strtotime($data["advert_add_time"]);
        $data["advert_end_time"] = strtotime($data["advert_end_time"]);
        $res = AdvertModel::insert($data);
        if($res){
            return true;
        }else{
            return false;
        }
    }

    public function advert_del($advert_id){
        $res = AdvertModel::where(["advert_id"=>$advert_id])->update(["advert_del"=>2]);
        if($res){
            return true;
        }else{
            return false;
        }
    }

    public function advert_upd($data){
        if (request()->hasFile('advert_logo')){
            $file = request()->file('advert_logo');
            if ($file->isValid()){
                $path = $file->store('images');
            }
        }
        $data["advert_logo"] = $path;
        $data["advert_add_time"] = strtotime($data["advert_add_time"]);
        $data["advert_end_time"] = strtotime($data["advert_end_time"]);
        $res = AdvertModel::where(["advert_id"=>$data["advert_id"]])->update($data);
        if($res){
            return true;
        }else{
            return false;
        }
    }
}
