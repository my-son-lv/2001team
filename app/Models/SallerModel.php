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
}
