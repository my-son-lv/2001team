<?php

namespace App\A;

use Illuminate\Database\Eloquent\Model;

class KaoShiModel extends Model
{
    protected $table = 'kaoshi';
    protected $primaryKey = 'kaoshi_id';
    public $timestamps = false;
}
