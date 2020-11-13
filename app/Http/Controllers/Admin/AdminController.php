<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    //首页
    public function home(){
        return view("admin.admin");
    }
    //列表展示
    public function index(){
        $admininfo=Admin::where('is_del',1)->get();
        // dd($admininfo);
        return view("admin/admin/index",['admininfo'=>$admininfo]);
    }
    //添加
    public function store(){
        $all=request()->except(['_token','data']);
        // dd($all);
        $all['add_time']=time();
        $all['admin_pwd']=bcrypt($all['admin_pwd']);
        $res=Admin::insert($all);
        if($res){
            return json_encode($arr=["code"=>0000,'msg'=>'添加成功']);
        }else{
            return json_encode($arr=['code'=>0001,'msg'=>'添加失败']);
        }
    }
    //编辑页面
    public function edit($admin_id){
        // echo $admin_id;
        $data=Admin::where(['admin_id'=>$admin_id,'is_del'=>1])->first();
        // dd($data);
        return view('admin.admin.edit',['data'=>$data]);
    }
    //修改
    public function upd(){
        $all=request()->all();
        $all['upd_time']=time();
        $all['admin_pwd']=bcrypt($all['admin_pwd']);
        // dd($all);
        $res=Admin::where('admin_id',$all['admin_id'])->update($all);
        if($res){
            return json_encode($arr=["code"=>0000,'msg'=>'修改成功']);
        }else{
            return json_encode($arr=['code'=>0001,'msg'=>'修改失败']);
        }
    }
    //删除
    public function del(){
        $admin_id=request()->admin_id;
        // dd($admin_id);
        $res=Admin::where('admin_id',$admin_id)->update(['is_del'=>2]);
        if($res){
            return json_encode($arr=['code'=>0000,'msg'=>'删除成功']);
        }else{
            return json_encode($arr=['code'=>0000,'msg'=>'删除失败']);
        }
    }
}