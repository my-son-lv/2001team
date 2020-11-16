<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        return view("index.index");
    }//首页

    public function index_list(){
        return view("index.index_list");
    }//列表

    public function index_show(){
        return view("index.index_show");
    }//详情
}
