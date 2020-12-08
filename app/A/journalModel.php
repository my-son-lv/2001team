<?php

namespace App\A;

use Illuminate\Database\Eloquent\Model;

class journalModel extends Model
{
    protected $table = 'journal';
    protected $primaryKey = 'journal_id';
    public $timestamps = false;
}
