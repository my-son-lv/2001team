<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Admin;
use Log;
use App\Models\Right;
class Loginsss
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $admin = session("admin");
        if(!$admin){
            return redirect('/admin_login');
        }
        $url = $request->url();
        $url = substr($url,19);
        if($url=="/admin"){
            return $next($request);
        }
            $data = Admin::where(["admin_name"=>$admin["admin_name"]])->first();
            if($data["prev"]==""){
                $res = Admin::leftjoin("admin_role","admin.admin_id","=","admin_role.admin_id")->leftjoin("role_right","admin_role.role_id","=","role_right.role_id")->where(["admin.admin_id"=>$admin["admin_id"]])->first()->toArray();
                $right_id = explode(",",$res["right_id"]);
                $urls = Right::whereIn("right_id",$right_id)->get()->toArray();
                $urlss = [];
                foreach($urls as $v){
                    $urlss[] = $v["right_url"];
                }
                if(in_array($url,$urlss)){
                    return $next($request);
                }else{
                    return redirect("/admin_login");
                }
            }else{
                return $next($request);
            }
    }
}