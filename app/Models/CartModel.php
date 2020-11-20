<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartModel extends Model
{
    protected $table="cart";
    protected $primarKey="cart_id";
    public $timestamps=false;
}
