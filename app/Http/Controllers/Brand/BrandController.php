<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand_Model;
use App\Models\GoodsModel;
class BrandController extends Controller
{
    public  function  brand(){
        $brand_name=request()->brand_name;
        $brand_info= Brand_Model::paginate(4);
//        dd($brand_info);
        return view("admin.brand.admin_brand",['brand_info'=>$brand_info]);
    }

    public function store(){
        $data=request()->all();
        if (request()->hasFile('brand_logo')){
            $file = request()->file('brand_logo');
            if ($file->isValid()){
                $path = $file->store('images');
//                dd($path);
            }
            $data["brand_logo"] = $path;
        }
        $brand_info=Brand_Model::insert($data);
        if($brand_info){
            $arr=[
                'code'=>0000,
                'msg'=>"添加成功",
                'url'=>"/admin/brand"
            ];
        }else{
            $arr=[
                'code'=>0001,
                'msg'=>"添加失败",
            ];
        }
        return json_encode($arr);
    }


    public  function  del(){
        $brand_id=request()->brand_id;
        $brand=GoodsModel::where('brand_id',$brand_id)->first();
        if($brand){
            return json_encode(['code'=>'0001','msg'=>"此品牌下有商品 不能删除！！！",'url'=>'/admin/brand']);
        }else{
            $info= Brand_Model::where("brand_id",$brand_id)->delete();
            if($info){
                $arr=[
                    'code'=>"0000",
                    'msg'=>"删除成功",
                    'url'=>"/admin/brand"
                ];
            }else{
                $arr=[
                    'code'=>"0001",
                    'msg'=>"删除失败",
                ];
            }
            return json_encode($arr);
        }
    }

    //批删
    public  function  dels(){
        $brand_id=request()->brand_id;
       $brand= Brand_Model::whereIn('brand_id',$brand_id)->delete();
        if($brand){
            return json_encode(['code'=>'0000','msg'=>"删除成功",'url'=>'/admin/brand']);
        }else{
            return json_encode(['code'=>'0001','msg'=>"删除失败",'url'=>'/admin/brand']);

        }
    }


    public  function  upd(){
        $brand_id=request()->brand_id;
       $info= Brand_Model::where("brand_id",$brand_id)->first();
        return view("admin.brand.upd",['info'=>$info]);

    }

    public  function  update_do(){
        $brand_id=request()->brand_id;
        $data=request()->all();
        if (request()->hasFile('brand_logo')){
            $file = request()->file('brand_logo');
            if ($file->isValid()){
                $path = $file->store('images');
            }
            $data["brand_logo"] = $path;
        }
        $brand_upd_info=Brand_Model::where("brand_id",$brand_id)->update($data);
        if($brand_upd_info){
            $arr=[
                "code"=>"0000",
                "msg"=>"修改成功",
                "url"=>"/admin/brand"
            ];
        }else{
           $arr=[
               "code"=>"0001",
               "msg"=>"修改失败",
           ];
        }
        return json_encode($arr);
    }

}
