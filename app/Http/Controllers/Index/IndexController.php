<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GoodsModel;
use App\Models\CateModel;
class IndexController extends Controller
{
    public function index(){
        $cate_cate = CateModel::get();
        $cate = CateModel::where(["pid"=>0])->limit(6)->get();
        $data = GoodsModel::where(["goods_status"=>1,"is_del"=>1,"is_shelf"=>1])->get()->toArray();
        $info = $this->GetIndo($cate_cate);
//        dd($cate);
        return view("index.index",["data"=>$data,"cate"=>$cate,"info"=>$info]);
        $url = "http://www.2001api.com/api/home";
        $cate = $this->postcurl($url);
        return view("index.index",["cate"=>$cate]);
    }//首页

    public function GetIndo($cate_cate,$pid=0){
        $info = [];
        foreach($cate_cate as $k=>$v){
            if($pid==$v->pid){
                $info[$k] = $v;
                $info[$k]["son"] = $this->GetIndo($cate_cate,$v->cate_id);
            }
        }
        return $info;
    }
    //列表
    public function index_list($cate_id){
        //分类导航
        $url = "http://www.2001api.com/api/home";
        $cate = $this->postcurl($url);
        return view("index.index_list",['cate'=>$cate]);
    }


    //详情
    public function index_show(){
        $goods_id=request()->goods_id;
//        dd($goods_id);
        $url=env('API_URL')."api/index/index_show";
        $data=$this->postcurl($url,['goods_id'=>$goods_id]);
//        dd($data['dat']);
        return view("index.index_show",['goods'=>$data['goods'],'cate'=>$data['cate'],'goods_img'=>$data['goodsimg'],'specs_val_info'=>$data['specs_val_info'],'specs_info'=>$data['specs_info']]);
    }
//API post curl
    public function postcurl($url,$postfield=[],$header=[]){
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
        return json_decode($result,true);
    }

}
