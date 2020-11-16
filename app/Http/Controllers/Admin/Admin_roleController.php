<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin_role;
use App\Models\Role;

class Admin_roleController extends Controller
{
     //列表展示
     public function index(){
        $info=Admin_role::select('admin_role_id','admin_role.role_id','role_name','admin_role.admin_id','admin_name','admin_role.add_time','admin_role.is_del')
                    ->leftjoin('admin','admin_role.admin_id','=','admin.admin_id')
                    ->leftjoin('role','admin_role.role_id','=','role.role_id')
                    ->where('admin_role.is_del',1)
                    ->paginate(3);
        // dd($info);
        return view("admin/admin_role/index",['info'=>$info]);
    }
     //编辑页面
     public function edit($admin_role_id){
        // echo $admin_id;
        $info=Admin_role::select('admin_role_id','admin_role.role_id','role_name','admin_role.admin_id','admin_name','admin_role.add_time','admin_role.is_del')
                    ->leftjoin('admin','admin_role.admin_id','=','admin.admin_id')
                    ->leftjoin('role','admin_role.role_id','=','role.role_id')
                    ->where('admin_role.is_del',1)
                    ->first();
        $data=Role::where('is_del',1)->get();

        // dd($data);

        return view('admin.admin_role.edit',['data'=>$data,'info'=>$info]);
    }
    //修改
    public function upd(){
        $all=request()->except('admin_name');
        // dd($all);
        $res=Admin_role::where('admin_role_id',$all['admin_role_id'])->update($all);
        if($res){
            return json_encode($arr=["code"=>0000,'msg'=>'修改成功']);
        }else{
            return json_encode($arr=['code'=>0001,'msg'=>'修改失败']);
        }
    }
    //删除
    public function del(){
        $admin_role_id=request()->admin_role_id;
        // dd($admin_id);
        $res=Admin_role::where('admin_role_id',$admin_role_id)->update(['is_del'=>2]);
        if($res){
            return json_encode($arr=['code'=>0000,'msg'=>'删除成功']);
        }else{
            return json_encode($arr=['code'=>0000,'msg'=>'删除失败']);
        }
    }
    
}
