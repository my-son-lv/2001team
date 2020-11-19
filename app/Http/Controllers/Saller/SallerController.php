<?php

namespace App\Http\Controllers\Saller;

use App\Http\Controllers\Controller;
use App\Models\SallerInfoModel;
use Illuminate\Http\Request;

class SallerController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 商家的首页
     */
    public function index(){
        return view('admin.saller.index');
    }
    /**
     * 商家的资料
     */
    public function saller(){
        $saller_info = session('saller_info');
        $saller_info_model = new SallerInfoModel();
        $saller_info_first = $saller_info_model->saller_info_first(['saller_id'=>$saller_info['saller_id']]);
        return view('admin.saller.saller',['saller_info_first'=>$saller_info_first]);
    }

    /**
     * 商家资料的修改
     */
    public function sallerdo(){
        $data = request()->all();
        $saller_id = $data['saller_id'];
        unset($data['saller_id']);
        $saller_info_model = new SallerInfoModel();
        $str = $saller_info_model->saller_info_update($saller_id,$data);
        if($str!==false){
            return json_encode(['code'=>'0000','msg'=>'成功','data'=>[]]);
        }
    }
    /**
     * 商家的修改密码
     */
    public function update_pwd(){
        return view('admin.saller.update_pwd');
    }
}
