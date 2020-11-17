<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponModel extends Model
{
    protected $table="coupon";
    protected $primarKey="coupon_id";
    public $timestamps=false;
}
