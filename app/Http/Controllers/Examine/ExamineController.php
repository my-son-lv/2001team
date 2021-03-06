<?php

namespace App\Http\Controllers\Examine;

use App\Http\Controllers\Controller;
use App\Models\GoodsModel;
use App\Models\SallerInfoModel;
use App\Models\SallerModel;
use Illuminate\Http\Request;

class ExamineController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 后台商家审核
     */
    public function examine(){
        $goods_name = request()->goods_name;
        $where = [];
        if($goods_name){
            $where[] = ['goods_name','like',"%$goods_name%"];
        }
        $goods_model = new GoodsModel();
        $goods_info = $goods_model->goods_info($where);
        $goods_info_model = new SallerInfoModel();
        foreach($goods_info as $k=>$v){
            if($v['saller_id']==0){
                $goods_info[$k]['saller_name'] = '自营';
            }else{
                $goods_info[$k]['saller_name'] = $goods_info_model->goods_info_saller_name($v['saller_id']);
            }
        }
//        dd($goods_info);
        return view('admin.examine.examine',['goods_info'=>$goods_info,'goods_name'=>$goods_name]);
    }

    /**
     * 审核通过
     */
    public function exam_true(){
        $goods_id = request()->goods_id;
        $goods_model = new GoodsModel();
        if(strpos($goods_id,',') !== false){

            $goods_id = explode(',',$goods_id);
//            dd($goods_id);
            foreach($goods_id as $v){
                $goods_model->goods_exam_true($v,1);
            }
        }else{
            $goods_model->goods_exam_true($goods_id,1);
        }
        $data = [
            'success'=>true,
            'msg'=>'成功',
            'data'=>[]
        ];
        return json_encode($data,true);
    }
    /**
     * 审核驳回
     */
    public function exam_false(){
        $goods_id = request()->goods_id;
        $goods_model = new GoodsModel();
        if(strpos($goods_id,',') !== false){
            $goods_id = explode(',',$goods_id);
            foreach($goods_id as $v){
                $goods_model->goods_exam_true($v,2);
            }
        }else{
            $goods_model->goods_exam_true($goods_id,2);
        }
        $data = [
            'success'=>true,
            'msg'=>'成功',
            'data'=>[]
        ];
        return json_encode($data,true);
    }
    /**
     * 商家审核
     */
    public function saller_exam(){
        $comp_name = request()->comp_name;
        $saller_name = request()->saller_name;
        $where = [];
        if($comp_name){
            $where[] = ['comp_name','like',"%$comp_name%"];
        }
        if($saller_name){
            $where[] = ['saller_name','like',"%$saller_name%"];
        }
        $saller_model = new SallerModel();
        $saller_info = $saller_model->saller_info($where);
//        dd($saller_info);
        return view('admin.examine.saller_exam',['saller_info'=>$saller_info,'comp_name'=>$comp_name,'saller_id'=>$saller_name]);
    }
    /**
     * 商家审核
     */
    public function saller_examine(){
        $saller_id = request()->saller_id;
        $saller_model = new SallerModel();
        $saller_info = $saller_model->saller_first($saller_id);
//        dd($saller_info);
        return view('admin.examine.saller_examine',['saller_info'=>$saller_info]);
    }
    /**
     * 通过
     */
    public function saller_true(){
        $saller_id = request()->saller_id;
        $saller_model = new SallerModel();
        $str = $saller_model->saller_status($saller_id,1);
        if($str!==false){
            $data = [
                'success'=>true,
                'msg'=>'成功',
                'data'=>[]
            ];
            return json_encode($data,true);
        }
    }
    /**
     * 未通过
     */
    public function saller_false(){
        $saller_id = request()->saller_id;
        $saller_model = new SallerModel();
        $str = $saller_model->saller_status($saller_id,2);
        if($str!==false){
            $data = [
                'code'=>'0000',
                'msg'=>'成功',
                'data'=>[]
            ];
            return json_encode($data,true);
        }

    }
    /**
     * 关闭商家
     */
    public function saller_down(){
        $saller_id = request()->saller_id;
        $saller_model = new SallerModel();
        $str = $saller_model->saller_status($saller_id,3);
        if($str!==false){
            $data = [
                'code'=>'0000',
                'msg'=>'成功',
                'data'=>[]
            ];
            return json_encode($data,true);
        }

    }


    /**
     * 商家管理
     */
    public function saller(){
        $comp_name = request()->comp_name;
        $saller_name = request()->saller_name;
        $saller_status = request()->saller_status;
        $where = [];
        if($comp_name){
            $where[] = ['comp_name','like',"%$comp_name%"];
        }
        if($saller_name){
            $where[] = ['saller_name','like',"%$saller_name%"];
        }
        if($saller_status){
            $where[] = ['saller_status','=',$saller_status];
        }
        $saller_model = new SallerModel();
        $saller_info = $saller_model->saller_infos($where);
//        dd($saller_info);
        return view('admin.examine.saller',['saller_info'=>$saller_info,'comp_name'=>$comp_name,'saller_name'=>$saller_name,'saller_status'=>$saller_status]);
    }
}
