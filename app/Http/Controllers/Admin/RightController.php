<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Right;

class RightController extends Controller
{
    //列表展示
    public function index(){
        $rightinfo=Right::where('is_del',1)->paginate(3);
        // dd($admininfo);
        return view("admin/right/index",['rightinfo'=>$rightinfo]);
    }
     //添加
     public function store(){
        // $all=request()->except(['_token','data']);
        $all=request()->all();
        // dd($all);
        $all['add_time']=time();
        $res=Right::insert($all);
        if($res){
            return json_encode($arr=["code"=>0000,'msg'=>'添加成功']);
        }else{
            return json_encode($arr=['code'=>0001,'msg'=>'添加失败']);
        }
    }
    //编辑页面
    public function edit($right_id){
        // echo $admin_id;
        $data=Right::where(['right_id'=>$right_id,'is_del'=>1])->first();
        // dd($data);
        return view('admin.right.edit',['data'=>$data]);
    }
    //修改
    public function upd(){
        $all=request()->all();
        $all['upd_time']=time();
        // dd($all);
        $res=Right::where('right_id',$all['right_id'])->update($all);
        if($res){
            return json_encode($arr=["code"=>0000,'msg'=>'修改成功']);
        }else{
            return json_encode($arr=['code'=>0001,'msg'=>'修改失败']);
        }
    }
    //删除
    public function del(){
        $right_id=request()->right_id;
        // dd($admin_id);
        $res=Right::where('right_id',$right_id)->update(['is_del'=>2]);
        if($res){
            return json_encode($arr=['code'=>0000,'msg'=>'删除成功']);
        }else{
            return json_encode($arr=['code'=>0000,'msg'=>'删除失败']);
        }
    }
}
