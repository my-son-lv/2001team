<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(){
        return view("index.login");
    }//前台登录

    public function reg(){
        return view("index.reg");
    }//前台注册
}
