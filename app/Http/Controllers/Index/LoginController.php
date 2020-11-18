<?php

namespace App\Http\Controllers\Index;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Console\Auth\Jwt;
use App\Models\Tel_code;
use App\Models\User;

class LoginController extends Controller
{
    //前台登录
    public function login(){
        return view("index.login");
    }
    //前台注册
    public function reg(){
        return view("index.reg");
    }
    //注册接口
    public function regstore(){
        $callback=request()->callback;
        $all=request()->all();
        if($all['user_name']==''){
            return json_encode($arr=['code'=>'0001','msg'=>'用户名不能为空']);
        }
        if($all['user_pwd']==''){
            return json_encode($arr=['code'=>'0001','msg'=>'密码不能为空']);
        }
        if($all['user_pwd']!==$all['user_pwds']){
            return json_encode($arr=['code'=>'0001','msg'=>'密码与确认密码不一致']);
        }
        if($all['user_tel']==''){
            return json_encode($arr=['code'=>'0001','msg'=>'手机号不能为空']);
        }
        $tel_code=Tel_code::where('tel',$all['user_tel'])->orderby('tel_code_id','desc')->first();
        // dd($tel_code);
        if($tel_code){
            if(time()-$tel_code->add_time>300){
                return json_encode($arr=['code'=>time(),'msg'=>'验证码已过期']);
            }
            if($all['user_code']!=$tel_code->code){
                return json_encode($arr=['code'=>'0001','msg'=>'手机号或验证码不符']);
            }
        }else{
            return json_encode($arr=['code'=>'0001','msg'=>'手机号或验证码不符']);
        }
        unset($all['user_code']);
        unset($all['user_pwds']);
        unset($all['m1']);
        unset($all['callback']);
        unset($all['_']);
        $all['user_pwd']=bcrypt($all['user_pwd']);
        $all['add_time']=time();
        // dd($all);
        $res=User::insert($all);
        if($res){
            // Tel_code::whereIn('user_tel',$all['user_tel'])->delete();
            return json_encode($arr=['code'=>'0000','msg'=>'注册成功']);
        }else{
            return json_encode($arr=['code'=>'0001','msg'=>'注册失败']);

        }

        // echo $callback.'(123)';die;
    }
  
    //API get curl
    public function getcurl($url,$header){
        //初始化
        $ch = curl_init();
        //设置
        curl_setopt($ch,CURLOPT_URL,$url);//获取url路径
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
        //执行
        $result = curl_exec($ch);
        //关闭
        curl_close($ch);
        return $result;
    }
    //API post curl
    public function postcurl($url,$postfield,$header=[]){
        //初始化
        $ch = curl_init();
        //设置
        curl_setopt($ch,CURLOPT_URL,$url);//获取url路径
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$postfield);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
        //执行
        $result = curl_exec($ch);
        //关闭
        curl_close($ch);
        return $result;
    }
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
        // }else{
        //     return json_encode(['code'=>'0001','msg'=>'发送次数已上线,请明日再试']);
        // }
        
        echo $callback.'(123)';die;
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
}
