<?php

namespace App\Http\Controllers\Saller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SallerController extends Controller
{
    public function index(){
        return view('admin.saller.index');
    }
}
