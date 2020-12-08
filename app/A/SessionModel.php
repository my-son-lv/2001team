<?php

namespace App\A;

use Illuminate\Database\Eloquent\Model;

class SessionModel extends Model
{
    protected $table = 'session';
    protected $primaryKey = 'kaoshi_session_id';
    public $timestamps = false;
}
