<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CateModel extends Model
{
    protected $table="category";
    protected $primarKey="cate_id";
    public $timestamps=false;
}
