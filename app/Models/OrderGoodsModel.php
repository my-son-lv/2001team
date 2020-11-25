<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderGoodsModel extends Model
{
    protected $table="order_goods";
    protected $primarKey="order_goods_id";
    public $timestamps=false;
    public function order_order_info($order_id){
        return OrderGoodsModel::where('order_id',$order_id)->get();
    }
}
