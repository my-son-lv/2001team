<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Right;
use App\Models\Role_right;

class Role_rightController extends Controller
{
     //列表展示
     public function index(){
        $info=Role::leftjoin("role_right","role.role_id","=","role_right.role_id")->get()->toArray();
        // dd($info);
        foreach($info as $v){
            $right_id[] = explode(",",$v["right_id"]);
        }
        $data = Right::get()->toArray();
        return view("admin/role_right/index",['info'=>$info,"data"=>$data,"right_id"=>$right_id]);
    }
     //删除
     public function del(){
        $role_right_id=request()->role_right_id;
        // dd($admin_id);
        $res=Role_right::where('role_right_id',$role_right_id)->update(['is_del'=>2]);
        if($res){
            return json_encode($arr=['code'=>0000,'msg'=>'删除成功']);
        }else{
            return json_encode($arr=['code'=>0000,'msg'=>'删除失败']);
        }
    }
     //编辑页面
     public function edit($role_right_id){
        // echo $admin_id;
        $info=Role_right::select('role_right_id','role_right.role_id','role_name','role_right.right_id','role_right.add_time')
                    ->leftjoin('role','role_right.role_id','=','role.role_id')   
                    ->leftjoin('right','role_right.right_id','=','right.right_id')
                    ->where(['role_right.is_del'=>1,'role_right_id'=>$role_right_id])
                    ->first();
        $data=Right::where('is_del',1)->get();

        // dd($info);

        return view('admin.role_right.edit',['data'=>$data,'info'=>$info]);
    }
    //修改
    public function upd(){
        $all=request()->all();
        $all['right_id']=implode(',',$all['right_id']);
        // $all['right_id']=implode(',',$all['right_id']);
        // $all=request()->all();
        // print_r($all);
        $res=Role_right::where('role_right_id',$all['role_right_id'])->update($all);
        // dd($res);
        if($res===false){
            return json_encode($arr=['code'=>0001,'msg'=>'修改失败']);
        }else{          
            return json_encode($arr=["code"=>0000,'msg'=>'修改成功']);
        }
    }
}
