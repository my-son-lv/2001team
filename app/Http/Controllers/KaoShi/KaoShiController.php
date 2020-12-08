<?php

namespace App\Http\Controllers\KaoShi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\A\KaoShiModel;
use App\A\journalModel;
use App\A\SessionModel;
class KaoShiController extends Controller
{
    public function kaoshi(){
        return view("kaoshi.kaoshi");
    }

    public function kaoshi_do(){
        $data = request()->all();
        $first = KaoShiModel::where(["zhanghao"=>$data["zhanghao"]])->first();
        if($data["mima"]==$first->mima){
            $session_id = md5($first->kaoshi_id.$first->zhanghao.time());
            session_id($session_id);
            session_start();
            $journal_Model = [
                "user_id"=>$first->kaoshi_id,
                "user_add_time"=>time(),
            ];
            $session = [
                "session"=>$session_id,
                "user_id"=>$first->kaoshi_id,
            ];
            journalModel::insert($journal_Model);
            SessionModel::insert($session);
            $user = [
                "session_id"=>$session_id,
                "user"=>$first
            ];
            request()->session()->put("session",$user);
            request()->session()->save();
            return json_encode(["code"=>0000,"message"=>"登录成功"]);
        }else{
//3377517225
        }
    }

    public function aaaa(){
        $user = session("session")["user"];
        $data = KaoShiModel::leftjoin("session","kaoshi.kaoshi_id","=","session.user_id")->where(["kaoshi.kaoshi_id"=>$user["kaoshi_id"]])->first();
        $db_session = $data->session;
        $session_session = session("session")["session_id"];
        if($db_session!=$session_session){
            request()->session()->forget("session");
            return redirect("/kaoshi")->with("未知错误");
        }else{
            dump(session("session"));
            echo "session有值";
        }
    }
}
