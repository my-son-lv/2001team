<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GoodsModel;
use App\Models\CateModel;
use App\Models\Brand_Model;
use App\Models\FootModel;
use App\Models\ColleModel;
use App\Models\Butti;
use Illuminate\Support\Facades\Redis;
class IndexController extends Controller
{
    public function getGoods(){
        $goods = GoodsModel::paginate(10);
        return response()->json($goods);
    }

    public function show(){
        $goods_id = request()->goods_id;
        dd($goods_id);
        return response()->json(GoodsModel::where(["goods_id"=>$goods_id])->first());
    }

    public function index(){
        $url = "http://www.2001api.com/api/home";
        $cate = $this->postcurl($url);
        $Butti = Butti::get();
        $goods=GoodsModel::where(['is_hot'=>'1','is_del'=>'1','is_shelf'=>'1','goods_status'=>'1'])->orderBy('goods_id','desc')->limit(4)->get();
        $brand = Brand_Model::limit(10)->get();
        // ob_start();
        // echo view('index.index',compact('cate','goods','brand','Butti'));
        // $contents = ob_get_contents();
        // $filename = 'index.html';
        // file_put_contents($filename,$contents);
        // ob_clean();
        return view("index.index",["cate"=>$cate,'goods'=>$goods,"brand"=>$brand,"Butti"=>$Butti]);
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
        $soncate_id=CateModel::where('pid',$cate_id)->pluck('cate_id');
        $soncate_id=$soncate_id?$soncate_id->toArray():[];
        array_push($soncate_id,intval($cate_id));
        // dump($soncate_id);
        // dump($cate_id);
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
        $where2=[['is_shelf','=','1'],['is_del','=','1']];
        $where=array_merge($where,$where2);
        // dd($where);
        // $goods=GoodsModel::where($where)->where(['cate_id'=>$cate_id,'is_shelf'=>1,'is_del'=>1])->paginate(4);
        $goods=GoodsModel::where($where)->whereIn('cate_id',$soncate_id)->paginate(4);
        // dump($goods);
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
    //获取价格
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
       $url = env('API_URL')."api/home";
       //猜你喜欢
       $home = $this->postcurl($url);
       $goods_id=request()->goods_id;
        $his=Redis::zincrby('hits',1,'hits_'.$goods_id);
//        dd($goods_id);
//        $toekn = $_COOKIE["token"];
//        $Foot_Model = new FootModel();
//        $Foot_Model->user_id = Redis::hget("token",$toekn);
//        $Foot_Model->goods_id = $goods_id;
//        $Foot_Model->save();
        $url=env('API_URL')."api/index/index_show";
        $data=$this->postcurl($url,['goods_id'=>$goods_id]);
//         dd($data);
        return view("index.index_show",["cate"=>$data,'home'=>$home,'his'=>$his]);
    }
//API post curl
    public function postcurl($url,$postfield=[],$headerArray=[]){
        if(is_array($postfield)){
            $postfield  = json_encode($postfield);
        }
        $headerArray =["Content-type:application/json;charset='utf-8'","Accept:application/json"];
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);//获取url路径
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$postfield);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$headerArray);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
        $result = curl_exec($ch);
//        echo $result;exit;
        curl_close($ch);
        if(is_null(json_decode($result,true))){
            return $result;
        }
        return json_decode($result,true);
    }

    public function user_colle(){
        if(isset($_COOKIE["token"])){
            $Colle_Model = new ColleModel();
            $token = $_COOKIE["token"];
            $Colle_Model->goods_id = request()->goods_id;
            $Colle_Model->user_id = Redis::hget("token",$token);
            $res = $Colle_Model->save();
            if($res){
                return json_encode(["code"=>0000,"message"=>"收藏OK"]);
            }else{
                return json_encode(["code"=>0001,"message"=>"收藏NO"]);
            }
        }else{
            return json_encode(["code"=>0001,"message"=>"请登录"]);
        }
    }
}