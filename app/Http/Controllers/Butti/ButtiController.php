<?php

namespace App\Http\Controllers\Butti;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Butti;
class ButtiController extends Controller
{
    public  function  create(){
        $butti_name=request()->butti_name;
        $where=[];
        if($butti_name){
            $where[]=['butti_name','like',"%$butti_name%"];
        }
        $butti=Butti::where($where)->paginate(4);
        return view("/admin/butti/create",['butti'=>$butti]);
    }

    public  function  store(){
        $data=request()->all();
        $data['add_time']=time();
        $butti_info=Butti::insert($data);
        if($butti_info){
            $arr=[
                'code'=>"0000",
                "msg"=>"添加成功",
                "url"=>"/admin/create",
            ];
        }else{
            $arr=[
                'code'=>"0001",
                "msg"=>"添加失败",
            ];
        }
        return json_encode($arr);
    }

    public  function  del(){
        $butti_id=request()->butti_id;
       $butti= Butti::where("butti_id",$butti_id)->delete();
        if($butti){
            $arr=[
                'code'=>"0000",
                "msg"=>"删除成功",
                "url"=>"/admin/create",
            ];
        }else{
            $arr=[
                'code'=>"0001",
                "msg"=>"删除失败",
            ];
        }
        return json_encode($arr);

    }


    public  function  upd(){
        $butti_id=request()->butti_id;
       $butti= Butti::where("butti_id",$butti_id)->first();
        return view("/admin/butti/upd",['butti'=>$butti]);
    }

    public  function  update_do(){
        $butti_id=request()->butti_id;
        $data=request()->all();
        $butti=Butti::where("butti_id",$butti_id)->update($data);
        if($butti){
            $arr=[
                'code'=>"0000",
                "msg"=>"修改成功",
                "url"=>"/admin/create",
            ];
        }else{
            $arr=[
                'code'=>"0001",
                "msg"=>"修改失败",
            ];
        }
        return json_encode($arr);


    }
}
