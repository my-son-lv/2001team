<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecsModel extends Model
{
    protected $table="specs";
//    protected $primarKey="id";
    public $timestamps=false;

    public function specs_first($where){
        return SpecsModel::where($where)->first();
    }
    public function specs_update($where,$data){
        return SpecsModel::where($where)->update($data);
    }
    public function specs_select($data){
        return SpecsModel::insert($data);
    }
}
