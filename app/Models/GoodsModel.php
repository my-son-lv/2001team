<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsModel extends Model
{
    protected $table="goods";
    protected $primarKey="goods_id";
    public $timestamps=false;
}
