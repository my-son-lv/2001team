<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PositionModel extends Model
{
    protected $table="position";
    protected $primarKey="position_id";
    public $timestamps=false;

    public function position_add($data){
        $data["position_add_time"] = strtotime($data["position_add_time"]);
        $data["position_end_time"] = strtotime($data["position_end_time"]);
        $res = PositionModel::insert($data);
        if($res){
            return true;
        }else{
            return false;
        }
    }
}
