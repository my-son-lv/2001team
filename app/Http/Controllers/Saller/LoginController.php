<?php

namespace App\Http\Controllers\Saller;

use App\Http\Controllers\Controller;
use App\Models\SallerInfoModel;
use App\Models\SallerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * 商家登录
     */
    public function login(){
        return view('admin.saller.login');
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 商家登录方法
     */
    public function logindo(){
        $username = request()->username;
        $password = request()->password;
        $saller_model = new SallerModel();
        $where = [
            ['username','=',$username]
        ];
        $saller_info = $saller_model->saller_name($where);
        if($saller_info){
            if(!Hash::check($password,$saller_info['password'])){
                return json_encode(['code'=>'0001','msg'=>'商家密码不正确','data'=>[]]);
            }
            return json_encode(['code'=>'0000','msg'=>'登录成功','data'=>[]]);
        }else{
            return json_encode(['code'=>'0001','msg'=>'商家账号不能为空','data'=>[]]);
        }
    }
    /*
     * 商家入驻
     */
    public function reg(){
        return view('admin.saller.reg');
    }
    /**
     * 商家入驻
     */
    public function regdo(){
        $data = request()->all();
        $data2 = [
            'username'=>$data['username'],
            'password'=>bcrypt($data['password']),
            'add_time'=>time()
        ];
        $saller_model = new SallerModel();
        $saller_id = $saller_model->saller_create($data2);
        if($saller_id){
            unset($data['username']);
            unset($data['password']);
            $data['saller_id'] = $saller_id;
            $saller_info_model = new SallerInfoModel();
            $str = $saller_info_model->saller_info_create($data);
            if($str){
                return json_encode(['code'=>'0000','msg'=>'成功','data'=>[]]);
            }
            dd($data);
        }
        return json_encode(['code'=>'30000','msg'=>'失败','data'=>[]]);
    }
}
