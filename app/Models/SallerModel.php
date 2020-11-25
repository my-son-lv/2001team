<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SallerModel extends Model
{
    protected $table = 'saller';
    protected $primaryKey = 'saller_id';
    public $timestamps = false;
    public function saller_create($data){
        return SallerModel::insertGetId($data);
    }
    public function saller_name($where){
        return SallerModel::where($where)->first();
    }
    public function saller_info(){
        return SallerModel::leftjoin('saller_info','saller.saller_id','=','saller_info.saller_id')->where(['saller.saller_status'=>0])->get();
    }
    public function saller_first($saller_id){
        return SallerModel::leftjoin('saller_info','saller.saller_id','=','saller_info.saller_id')->where('saller.saller_id',$saller_id)->first();
    }
    public function saller_status($saller_id,$res){
        return SallerModel::where('saller_id',$saller_id)->update(['saller_status'=>$res]);
    }
    public function saller_infos(){
        return SallerModel::leftjoin('saller_info','saller.saller_id','=','saller_info.saller_id')->get();
    }
    public function saller_status_true($saller_id){
        return SallerModel::where('saller_id',$saller_id)->value('saller_status');
    }
}
