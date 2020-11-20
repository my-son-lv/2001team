<?php

namespace App\Http\Controllers\Api;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tel_code;
use App\Models\User;
use App\Common\Jwt;

class LoginController extends Controller
{
    //登录接口
    public function logstore(){
        // echo encrypt(123);die;
        $all=request()->all();
        if($all['user_name']==''){
            return json_encode($arr=['code'=>'0001','msg'=>'用户名不能为空']);
        }
        if($all['user_pwd']==''){
            return json_encode($arr=['code'=>'0001','msg'=>'密码不能为空']);
        }
        $user=User::where('user_name',$all['user_name'])->first();
        // print_r($user->user_pwd);
        $user['user_pwd']=decrypt($user['user_pwd']);
        // echo $user;die;

        if($user){
            // var_dump($user);
            if($user['user_pwd']==$all['user_pwd']){
                $user_id=$user['user_id'];
                $jwtAuth = Jwt::getInstance();
                $token = $jwtAuth->setUid($user_id)->encode()->getToken();
                // dd($token);
                //解密token
                // $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiJodHRwOlwvXC9leGFtcGxlLmNvbSIsImF1ZCI6Imh0dHA6XC9cL2V4YW1wbGUub3JnIiwianRpIjoiNGYxZzIzYTEyYWEiLCJpYXQiOjE2MDU3MDExNDEsIm5iZiI6MTYwNTcwMTIwMSwiZXhwIjoxNjA1NzA0NzQxLCJ1aWQiOjJ9.BYBySnOhqjAeNJhZ7nMvHQe0pv6_b8riOoj1vgYa3Qg";
                // $jwtAuth = Jwt::getInstance();
                // $jwtAuth->setToken($token);
                // // // dd($jwtAuth);
                //     if ($jwtAuth->validate() && $jwtAuth->verify()){ //验签
                //         $user_id = $jwtAuth->getUid();//解密并获取数据信息
                //         dd($user_id);
                //     }else{
                //         dd('0909');
                //     }
                return json_encode($arr=['code'=>'0000','msg'=>'登录成功','token'=>$token,'user_id'=>$user_id]);
            }else{
                return json_encode($arr=['code'=>'0001','msg'=>'密码错误']);
            }
        }else{
            return json_encode($arr=['code'=>'0001','msg'=>'用户名错误']);
        }
    }
}