<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    protected $table="order_info";
    protected $primarKey="order_id";
    public $timestamps=false;
    public function order_index($saller_id){
        return OrderModel::where('saller_id',$saller_id)->orderBy('add_time','desc')->paginate(10);
    }
}
