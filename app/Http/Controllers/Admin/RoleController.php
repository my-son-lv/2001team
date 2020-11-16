<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Right;
use App\Models\Role_right;

class RoleController extends Controller
{
     //列表展示
     public function index(){
        $roleinfo=Role::where('is_del',1)->paginate(3);
        // dd($admininfo);
        return view("admin/role/index",['roleinfo'=>$roleinfo]);
    }
     //添加
     public function store(){
        $all=request()->except(['_token','data']);
        // dd($all);
        $all['add_time']=time();
        $res=Role::insert($all);
        if($res){
            return json_encode($arr=["code"=>0000,'msg'=>'添加成功']);
        }else{
            return json_encode($arr=['code'=>0001,'msg'=>'添加失败']);
        }
    }
    //编辑页面
    public function edit($role_id){
        // echo $admin_id;
        $data=Role::where(['role_id'=>$role_id,'is_del'=>1])->first();
        // dd($data);
        return view('admin.role.edit',['data'=>$data]);
    }
    //修改
    public function upd(){
        $all=request()->all();
        $all['upd_time']=time();
        // dd($all);
        $res=Role::where('role_id',$all['role_id'])->update($all);
        if($res){
            return json_encode($arr=["code"=>0000,'msg'=>'修改成功']);
        }else{
            return json_encode($arr=['code'=>0001,'msg'=>'修改失败']);
        }
    }
    //删除
    public function del(){
        $role_id=request()->role_id;
        // dd($admin_id);
        $res=Role::where('role_id',$role_id)->update(['is_del'=>2]);
        if($res){
            return json_encode($arr=['code'=>0000,'msg'=>'删除成功']);
        }else{
            return json_encode($arr=['code'=>0000,'msg'=>'删除失败']);
        }
    }
    //赋予权限
    public function right($role_id){
        $role=Role::where('role_id',$role_id)->first();
        $data=Right::where('is_del',1)->get();
        // dd($data);
        return view('admin.role.right',['data'=>$data,'role'=>$role]);
    }
    //执行赋予
    public function rightstore(){
        $all=request()->except('role_name');
        $all['right_id']=implode(',',$all['right_id']);
        $all['add_time']=time();
        // dd($all);
        $res=Role_right::insert($all);
        if($res){
            return json_encode($arr=['code'=>0000,'msg'=>'赋予成功']);
        }else{
            return json_encode($arr=['code'=>0001,'msg'=>'赋予失败']);
        }
    }
}
