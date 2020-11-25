<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartModel extends Model
{
    protected $table="cart";
    protected $primarKey="cart_id";
    public $timestamps=false;

    public  static  function  getprice($cart_id){
        if(is_array($cart_id)){
            $cart_id = implode(',',$cart_id);
        }
        $cart = \DB::select("select sum(buy_number*goods_price) as total from cart where cart_id in ($cart_id)");
        return $cart;
    }
}
