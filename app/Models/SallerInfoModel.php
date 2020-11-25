<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SallerInfoModel extends Model
{
    protected $table = 'saller_info';
//    protected $primaryKey = 'saller_id';
    public $timestamps = false;
    public function saller_info_create($data){
        return SallerInfoModel::insert($data);
    }
    public function saller_info_first($where){
        return SallerInfoModel::where($where)->first();
    }
    public function saller_info_update($saller_id,$data){
        return SallerInfoModel::where('saller_id',$saller_id)->update($data);
    }
    public function goods_info_saller_name($saller_id){
        return SallerInfoModel::where('saller_id',$saller_id)->value('saller_name');
    }
}
