<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistics extends Model
{
    /**
     * 商家统计表
     */
    protected $table="statistics";
    protected $primarKey="stat_id";
    public $timestamps=false;

}
