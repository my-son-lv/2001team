<?php

namespace App\Http\Controllers\Cate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CateModel;
use App\Http\Requests\StoreCategoryPost;
class CatrController extends Controller
{
    public  function  create(Request $request){
        $cateinfo=CateModel::get();
        $cateinfo=$this->createTree($cateinfo);
        return view("/admin/cate/create",['cateinfo'=>$cateinfo]);
    }

    //分类无限极分类
    function createTree($data,$parent_id=0,$level=0){
        if(!$data){
            return;
        }
        static $newArray=[];
        foreach($data as $v){
            if($v->pid==$parent_id){
                $v->level=$level;
                $newArray[]=$v;
                $this->createTree($data,$v->cate_id,$level+1);

            }
        }
        return $newArray;
    }

    public  function  store(){
        $CateModel = new CateModel();
        $CateModel->pid = request()->pid;
        $CateModel->cate_name = request()->butti_name;
        $CateModel->cate_show = request()->cate_show;
        $CateModel->cate_nav_show = request()->cate_nav_show;
        if($CateModel->save()){
            return json_encode(["code"=>0000,"message"=>"添加成功"]);
        }else{
            return json_encode(["code"=>0001,"message"=>"添加失败"]);
        }
    }

    public  function  check_cateshows(){
        $cate_id=request()->cate_id;
        $_field=request()->_field;
        $data[$_field]=request()->is_show==1?2:1;
        $res=CateModel::where(['cate_id'=>$cate_id])->update($data);
        if($res){
            return json_encode(["code"=>0000,"message"=>"Ok",'data'=>$data[$_field]]);
        }else{
            return json_encode(["code"=>0001,"message"=>"No"]);
        }
    }

    public  function  del(){
        $cate_id=request()->cate_id;
        $res=CateModel::where("cate_id",$cate_id)->delete();
        if($res){
            return json_encode(['code'=>0000,'msg'=>"删除成功",'url'=>"/admin/cate/create"]);
        }else{
            return json_encode(['code'=>0001,'msg'=>"删除失败"]);
        }
    }
    public  function  upd(){
        $cate_id=request()->cate_id;
        $cateinfo=CateModel::get();
        $cateinfo=$this->createTree($cateinfo);
        $cate=CateModel::where("cate_id",$cate_id)->first();
        return  view('/admin/cate/upd',['cate'=>$cate,'cateinfo'=>$cateinfo]);
    }

    public  function update_do(){
        $data=request()->all();
        $info=CateModel::where(['cate_id'=>$data['cate_id']])->update($data);
        if($info){
            return json_encode(['code'=>'0000','msg'=>"修改成功",'url'=>"/admin/cate/create"]);
        }else{
            return json_encode(['code'=>'0001','msg'=>"修改失败",'url'=>"/admin/cate/create"]);

        }

    }


}
