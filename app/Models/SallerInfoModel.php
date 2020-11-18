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
}
