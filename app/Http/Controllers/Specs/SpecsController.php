<?php

namespace App\Http\Controllers\Specs;

use App\Http\Controllers\Controller;
use App\Models\Specsname_Model;
use App\Models\Specsval_Model;
use Illuminate\Http\Request;

class SpecsController extends Controller
{
    /**
     * 规格展示
     */
    public function specs(){
        $specs_name_model = new Specsname_Model();
        $specs_val_model = new Specsval_Model();
        $specs_name_info = $specs_name_model->specs_name_info();
        $specs_val_info = $specs_val_model->specs_value_info();
        return view('admin.specs.specs',['specs_name_info'=>$specs_name_info,'specs_val_info'=>$specs_val_info]);
    }
    /**
     * 规格添加方法
     */
    public function specs_create(){
        $specs_val = request()->specs_val;
        $specs_name = request()->specs_name;

        $specs_name_model = new Specsname_Model();
        $specs_val_model = new Specsval_Model();
        $specs_id = $specs_name_model->specs_name_id($specs_name);
        if(!$specs_id){
            $data = [
                'add_time'=>time(),
                'specs_name'=>$specs_name
            ];
            $specs_id = $specs_name_model->specs_name_create($data);
        }
        if(strpos($specs_val,',')){
            $specs_val = explode(',',$specs_val);
            foreach($specs_val as $k=>$v){
                $str = $specs_val_model->specs_value_id($specs_id,$specs_val);
                if(!$str){
                    $specs_val_model->specs_value_create(['specs_id'=>$specs_id,'specs_val'=>$v,'add_time'=>time()]);
                }
            }
        }else{
            $str = $specs_val_model->specs_value_id($specs_id,$specs_val);
            if(!$str){
                $specs_val_model->specs_value_create(['specs_id'=>$specs_id,'specs_val'=>$specs_val,'add_time'=>time()]);
            }
        }
        return ['code'=>0000,'msg'=>'成功','data'=>[]];

    }
    public function specs_upd(){
        $specs_id = request()->specs_id;
        $specs_name_model = new Specsname_Model();
        $specs_val_model = new Specsval_Model();
        $specs_name_info = $specs_name_model->specs_name_first($specs_id);
        $specs_val_info = $specs_val_model->specs_value_first($specs_id);
        return view('admin.specs.upd',['specs_name_info'=>$specs_name_info,'specs_val_info'=>$specs_val_info]);
    }
}
