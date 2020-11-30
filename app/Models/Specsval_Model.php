<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specsval_Model extends Model
{
    protected $table="specs_val";
//    protected $primarKey="specs_id";
    public $timestamps=false;
    public function specs_value_info(){
        return Specsval_Model::get();
    }
    public function specs_value_create($data){
        return Specsval_Model::insert($data);
    }
    public function specs_value_id($specs_id,$specs_val){
        return Specsval_Model::where(['specs_id'=>$specs_id,'specs_val'=>$specs_val])->first();
    }
    public function specs_value_first($specs_id){
        return Specsval_Model::where(['specs_id'=>$specs_id])->get();
    }
    public function specs_val($id){
        return Specsval_Model::where('id',$id)->value('specs_val');
    }
}
