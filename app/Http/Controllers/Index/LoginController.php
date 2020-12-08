<?php

namespace App\Http\Controllers\Index;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tel_code;
use App\Models\User;
use Illuminate\Support\Facades\Redis;
use App\Common\Jwt;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    //测试
    public function test(){
        if(isset($_COOKIE['token'])){
            dd($_COOKIE['token']);
        }else{
            dd('cookie为空');
        }
    }
    //前台登录
    public function login(){
        return view("index.login");
    }
    //执行登录
    public function logindo(){
        $data=request()->all();
        //dd($data);
        if(!isset($_COOKIE['token'])){
//             dd(123);
            $url="http://www.2001api.com/api/logstore";
            $res=$this->postcurl($url,$data);
            // dd($res);
            if($res['code']=='0000'){
                Redis::Hset('token',$res['token'],$res['user_id']);
                setcookie('token',$res['token']); //存cookie
                setcookie('user_name',$data['user_name']);
                // Cookie::make('token', $res['token']);
                // dd($_COOKIE['token']);//取cookie
                return json_encode($res);
            }else{
                return json_encode($res);
            }
        }else{
            return json_encode($arr=['code'=>'0002','msg'=>'请退出登录后再试']);
        }
    }
    //前台注册
    public function reg(){
        return view("index.reg");
    }
    //注册接口
    public function regstore(){
        $callback=request()->callback;
//        echo $callback.'(123)';exit;
        $all=request()->all();
        // dd($all);
        $user=User::where('user_name',$all['user_name'])->count();
        if($all['user_name']==''){
            $arr=json_encode(['code'=>'0001','msg'=>'用户名不能为空']);
            echo $callback.'('.$arr.')';exit;
        }else if($user>0){
            $arr=json_encode(['code'=>'0002','msg'=>'用户名已存在']);
            echo $callback.'('.$arr.')';exit;
        }
        if($all['user_pwd']==''){
            $arr=json_encode(['code'=>'0001','msg'=>'密码不能为空']);
            echo $callback.'('.$arr.')';exit;
        }
        if($all['user_pwd']!==$all['user_pwds']){
            $arr=json_encode(['code'=>'0001','msg'=>'密码与确认密码不一致']);
            echo $callback.'('.$arr.')';exit;
        }
        if($all['user_tel']==''){
            $arr=json_encode(['code'=>'0001','msg'=>'手机号不能为空']);
            echo $callback.'('.$arr.')';exit;
        }

        $tel_code=Tel_code::where('tel',$all['user_tel'])->orderby('tel_code_id','desc')->first();
        // dd($tel_code);
        if($tel_code){
            if(time()-$tel_code->add_time>300){
                $arr=json_encode(['code'=>time(),'msg'=>'验证码已过期']);
                echo $callback.'('.$arr.')';exit;
            }
            if($all['user_code']!=$tel_code->code){
                $arr=json_encode(['code'=>'0001','msg'=>'手机号或验证码不符']);
                echo $callback.'('.$arr.')';exit;
            }
        }else{
            $arr=json_encode(['code'=>'0001','msg'=>'手机号或验证码不符']);
            echo $callback.'('.$arr.')';exit;
        }
        unset($all['user_code']);
        unset($all['user_pwds']);
        unset($all['m1']);
        unset($all['callback']);
        unset($all['_']);
        $all['user_pwd']=encrypt($all['user_pwd']);
        $all['add_time']=time();
        // dd($all);
        $res=User::insert($all);
        if($res){
            // Tel_code::whereIn('user_tel',$all['user_tel'])->delete();
            $arr=json_encode(['code'=>'0000','msg'=>'注册成功']);
            echo $callback.'('.$arr.')';exit;
        }else{
            $arr=json_encode(['code'=>'0001','msg'=>'注册失败']);
            echo $callback.'('.$arr.')';exit;

        }
    }
  
    //API get curl
    public function getcurl($url){
        $headerArray =["Content-type:application/json;","Accept:application/json"];
        $ch = curl_init();//初始化
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); //路径是https请求方式 跳过证书认证
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//数据以字符串形式返回,不是直接输出到浏览器
        curl_setopt($ch,CURLOPT_HTTPHEADER,$headerArray);//添加header头信息
        $output = curl_exec($ch);//执行
        curl_close($ch);//关闭
        $output = json_decode($output,true);//将json串转换为数组
        return $output;
    }
//     //API post curl
    public function postcurl($url,$data=[]){
// $headerArray =["Content-type:application/json;charset='utf-8'","Accept:application/json"];
        $headerArray=[];
        $curl = curl_init();//初始化
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,FALSE);
        curl_setopt($curl, CURLOPT_POST, 1);//设置post提交
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);//post提交表单数据
        curl_setopt($curl,CURLOPT_HTTPHEADER,$headerArray);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return json_decode($output,true);
    }
    //API post curl
    // public function postcurl($url,$postfield=[],$headerArray=[]){
    //     if(is_array($postfield)){
    //         $postfield  = json_encode($postfield);
    //     }
    //     $headerArray =["Content-type:application/json;charset='utf-8'","Accept:application/json"];
    //     $ch = curl_init();
    //     curl_setopt($ch,CURLOPT_URL,$url);//获取url路径
    //     curl_setopt($ch,CURLOPT_POST,true);
    //     curl_setopt($ch,CURLOPT_POSTFIELDS,$postfield);
    //     curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    //     curl_setopt($ch,CURLOPT_HTTPHEADER,$headerArray);
    //     curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
    //     curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
    //     $result = curl_exec($ch);
    //     curl_close($ch);
    //     if(is_null(json_decode($result,true))){
    //         return $result;
    //     }
    //     return json_decode($result,true);
    // }
    //发送短信验证码
    public function sendcode(){  
        $callback=request()->callback; 
        $user_tel = request()->user_tel;
        // $count=Tel_code::where('tel',$all['user_tel'])->count();
        // if($count<3){
            $code= rand(100000,999999);
            $reg='/^1[3|4|5|6|7|8|9]\d{9}$/';
            if(preg_match($reg,$user_tel)){
                //手机发送验证码
                $res= $this->sendSms($user_tel,$code);
                // dd($res);
                if($res['Message']=='OK'){
                        $data=['tel'=>$user_tel,'code'=>$code,'add_time'=>time()];
                        $tel_code_id=Tel_code::insertGetid($data);
                        return json_encode(['code'=>'0000','msg'=>'短信发送成功']);
                }else{
                    return json_encode(['code'=>'0001','msg'=>'短信发送失败']);
                }
    
            }else{
                return json_encode(['code'=>'0001','msg'=>'手机号不规范']);    
            }
        // }else{}
        //     return json_encode(['code'=>'0001','msg'=>'发送次数已上线,请明日再试']);
        // }
        
        // echo $callback.'(123)';die;
    }
    //短信发送验证码
    public function sendSms($user_tel,$code){

        // Download：https://github.com/aliyun/openapi-sdk-php
        // Usage：https://github.com/aliyun/openapi-sdk-php/blob/master/README.md

        AlibabaCloud::accessKeyClient('LTAI4FsuM8szkCjwXCfMHC7H', 'uCnLC1PShQFIhtn6hmcLj4HAv7VHNm')
                                ->regionId('cn-hangzhou')
                                ->asDefaultClient();

        try {
            $result = AlibabaCloud::rpc()
                                ->product('Dysmsapi')
                                // ->scheme('https') // https | http
                                ->version('2017-05-25')
                                ->action('SendSms')
                                ->method('POST')
                                ->host('dysmsapi.aliyuncs.com')
                                ->options([
                                                'query' => [
                                                'RegionId' => "cn-hangzhou",
                                                'PhoneNumbers' => $user_tel,
                                                'SignName' => "小扶面包",
                                                'TemplateCode' => "SMS_183261700",
                                                'TemplateParam' => "{code:$code}",
                                                ],
                                            ])
                                ->request();
            return $result; 
        } catch (ClientException $e) {
            return $e->getErrorMessage() . PHP_EOL;
        } catch (ServerException $e) {
            return $e->getErrorMessage() . PHP_EOL;
        }
    }
    public function loginout(){
        $res=setcookie("token","",time()-1);
        if($res){
            return redirect('/login');
        }else{
            return redirect('/');
        }
    }
}
