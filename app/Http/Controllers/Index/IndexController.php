<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GoodsModel;
use App\Models\CateModel;
use App\Models\Brand_Model;
class IndexController extends Controller
{
    public function index(){
        $url = "http://www.2001api.com/api/home";
        $cate = $this->postcurl($url);
        $goods=GoodsModel::where('is_hot',1)->orderBy('goods_id','desc')->limit(4)->get();
        // dd($goods);
        return view("index.index",["cate"=>$cate,'goods'=>$goods]);
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
        // $soncate_id=CateModel::where('pid',$cate_id)->pluck('cate_id');
        // $soncate_id=$soncate_id?$soncate_id->toArray():[];
        $query=request()->all();
        // dump($query);
        $where=[];
        if(isset($query['brand_id'])){
            $where[]=[
                'brand_id','=',$query['brand_id']
            ];
        }
        if(isset($query['price'])){
            $price_array = explode('元',$query['price']);
            $price_array = explode('-',$price_array[0]);
            // dump($price_array); 
            $where[]=['goods_price','>',$price_array[0]];
            if(isset($price_array[1])){
                $where[]=['goods_price','<',$price_array[1]];
            }
        }
        // dump($where);
        $goods=GoodsModel::where($where)->where(['cate_id'=>$cate_id,'is_shelf'=>1,'is_del'=>1])->paginate(3);
        // dd($cate_id);
        $goods_price=GoodsModel::where(['is_shelf'=>1,'is_del'=>1,'cate_id'=>$cate_id])->max('goods_price');
        if ($goods_price) {
            $price=$this->getPrice($goods_price); 
        } else {
            $price[] = "该分类下没有商品";
        }
        // dd($price);
        $goods_hot=GoodsModel::where(['cate_id'=>$cate_id,'is_shelf'=>1,'is_del'=>1,'is_hot'=>1])->limit(4);
        $cate_name=CateModel::where('cate_id',$cate_id)->first();
        $brand_ids = GoodsModel::where('cate_id',$cate_id)->pluck('brand_id');
        $brand_ids=$brand_ids?$brand_ids->toArray():[];
        $brand_ids=array_unique($brand_ids);
        // dd($brand_ids);
        $brand=Brand_Model::whereIn('brand_id',$brand_ids)->get();
        // dd($brand);
        return view("index.index_list",['cate'=>$cate,'goods'=>$goods,'goods_hot'=>$goods_hot,'cate_name'=>$cate_name,'brand'=>$brand,'price'=>$price,'query'=>$query]);
    }
    public function getPrice($goods_price){
        // dd($goods_price);
        $length=strlen($goods_price);
        $format='1'.str_repeat(0,$length-1);
        $maxprice=substr($goods_price,0,1);
        $maxprice=$maxprice*$format;
        // dd($maxprice);
        // 计算价格阶段
        $price=[];
        $avgprice=$maxprice/5;
        for($i=0,$j=1;$i<$maxprice;$i++,$j++){
            $price[]=$i.'-'.$avgprice*$j.'元';
            $i=$avgprice*$j-1;
        }
        $price[]=$maxprice.'元以上';
        // dd($price);
        return $price;
    }


    //详情
    public function index_show(){
        $url = "http://www.2001api.com/api/home";
        $cate = $this->postcurl($url);
        $goods_id=request()->goods_id;
        $url=env('API_URL')."api/index/index_show";
        $data=$this->postcurl($url,['goods_id'=>$goods_id]);
        return view("index.index_show",['goods'=>$data['goods'],'cate'=>$data['cate'],'goods_img'=>$data['goodsimg'],'specs_val_info'=>$data['specs_val_info'],'specs_info'=>$data['specs_info'],'cate'=>$cate]);
    }
//API post curl
    public function postcurl($url,$postfield=[],$header=[]){
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);//获取url路径
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$postfield);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result,true);
    }

}