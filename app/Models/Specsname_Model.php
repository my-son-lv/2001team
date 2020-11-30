<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specsname_Model extends Model
{
    protected $table="specs_name";
    protected $primarKey="specs_id";
    public $timestamps=false;

    public function specs_name_info(){
        return Specsname_Model::get();
    }
    public function specs_name_create($data){
        return Specsname_Model::insertGetId($data);
    }
    public function specs_name_id($specs_name){
        return Specsname_Model::where(['specs_name'=>$specs_name])->value('specs_id');
    }
    public function specs_name_first($specs_id){
        return Specsname_Model::where(['specs_id'=>$specs_id])->first();
    }
    public function specs_name($specs_id){
        return Specsname_Model::where('specs_id',$specs_id)->value('specs_name');
    }
}
