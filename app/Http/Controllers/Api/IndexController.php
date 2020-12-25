<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KillModel;
use App\Models\SallerInfoModel;
use App\Models\SpecsModel;
use Illuminate\Http\Request;
use App\Models\CateModel;
use App\Models\GoodsModel;
use App\Models\GoodsImgsModel;
use App\Models\Specsname_Model;
use App\Models\Specsval_Model;
use App\Models\CartModel;
use App\Models\AddressModel;
use App\Models\OrderGoodsModel;
class IndexController extends Controller
{
    //商品详情
    public function index_show(){
        $cate_cate = CateModel::get();
        $cate = CateModel::where(["pid"=>0])->limit(6)->get();
//         dd($cate);
        $goods_id=request()->goods_id;
        $goodsimg=GoodsImgsModel::where("goods_id",$goods_id)->get();
//        dd($goodsimg);
            $saller_model = new SallerInfoModel();
//        dd($goodsimg);
        $goods=GoodsModel::where("goods_id",$goods_id)->first();
//        dd($goods);
        if($goods['saller_id']==0){
            $goods['saller_name'] = '品优购自营';
        }else{
            $goods['saller_name'] = $saller_model->where('saller_id',$goods['saller_id'])->value('saller_name');
        }
       //规格
        $specs_model = new Specsname_Model();
        $specs_val_model = new Specsval_Model();
        //相关分类
        $cateinfo=GoodsModel::where('cate_id',$goods['cate_id'])->limit(5)->get();
        // dd($cateinfo);
        //热卖商品
        $hot=GoodsModel::where(['is_hot'=>'1','is_del'=>'1','is_shelf'=>'1','goods_status'=>'1'])->orderBy('goods_id','desc')->limit(4)->get();
        $specs_model_model = new SpecsModel();
        $specs_info = $specs_model_model->where('goods_id',$goods_id)->get();
        $data = [];
        if($specs_info){
            $specs_info = $specs_info->toArray();
            foreach($specs_info as $k=>$v){
                $res = explode(':',$v['specs']);
                if($res){
                    $r = count($res);
                    for($i=0;$i<$r;$i++){
                        array_push($data,$res[$i]);
                    }
                }
            }
            $data = array_unique($data);
            foreach($data as $k=>$v){
                if($v){
                    $data[$k] = explode(',',$v);
                    $data[$k]['specs_name'] = $specs_model->where('specs_id',$v[0])->value('specs_name');
                    $data[$k]['specs_id'] = $v[0];
                    $data[$k]['specs_val'] = $specs_val_model->where('id',$data[$k][1])->value('specs_val');
                    $data[$k]['specs_val_id'] = $data[$k][1];
                    unset($data[$k][0]);
                    unset($data[$k][1]);
                }
            }
            $newdata = [];
            foreach($data as $k=>$v){
            $newdata[$v['specs_id']]['specs_name'] = $v['specs_name'];
            $newdata[$v['specs_id']]['specs'][$v['specs_val_id']] = $v['specs_val'];
            }
        }
        $cate = ['cate'=>$cate,'goods'=>$goods,'cate_cate'=>$cate_cate,'goodsimg'=>$goodsimg,'newdata'=>$newdata,'cateinfo'=>$cateinfo,'hot'=>$hot];
//        dd($cate);
        return $cate;
    }
//加入购物车
    public  function  addcart()
    {
        // $uid=1;
        $goods_id = request()->goods_id;
//        dd($goods_id);
        $goods_number = request()->goods_number;
        $goods_attr_id = request()->goods_attr_id;
//        $uid=1;
        $uid = request()->uid;
        if (!$goods_id || !$goods_number) {
            return json_encode(['code' => '0001', 'msg' => "缺少参数"]);
        }
        $goods = GoodsModel::where("goods_id", $goods_id)->first();
        if ($goods['is_shelf'] !== 1) {
            return json_encode(['code' => '0001', 'msg' => "商品已下架"]);
        }
        if ($goods_attr_id == "") {
            $res = GoodsModel::where("goods_id", $goods_id)->first();
            if ($res['goods_number'] < $goods_number) {
                return json_encode(['code' => '0001', 'msg' => "商品库存不足"]);
            }
        } else {
            $specs = SpecsModel::where(['goods_id' => $goods_id, 'specs' => $goods_attr_id])->first();
            if (!$specs) {
                return json_encode(['code' => '0001', 'msg' => "库存不足"]);
            } else {
                if ($specs['goods_number'] < $goods_number) {
                    return json_encode(['code' => '0001', 'msg' => "商品库存不足"]);
                }
            }
        }
        $where1 = [];
        $where1[] = ['user_id', '=', $uid];
        $where1[] = ['goods_id', '=', $goods_id];
        if ($goods_attr_id) {
            $where1[] = ['specs_id', '=', $goods_attr_id];
        }
//        dd($where1);
        $cart = CartModel::where($where1)->first();
//        dd($cart);
        if ($cart) {
            if ($goods_attr_id) {
                //关联
                if ($goods_number + $cart['buy_number'] > $specs->goods_number) {
                    $goods_number = $specs->goods_number;
                } else {
                    $goods_number = $goods_number + $cart['buy_number'];
                }
//                dd($goods_number); 
            } else {
                //商品
                if ($goods_number + $goods->goods_number > $goods['goods_number']) {
                    $goods_number = $goods->goods_number;
//                dd($goods->goods_number);
                    if ($goods_number + $cart['buy_number'] > $goods->goods_number) {
                        $goods_number = $goods->goods_numbe;
                    } else {
                        $goods_number = $goods_number + $cart['buy_number'];
                    }
//                dd($goods_number);
                }
            }
            $res = CartModel::where("cart_id", $cart->cart_id)->update(['buy_number' => $goods_number]);
        } else{
                $saller_id = GoodsModel::where("goods_id", $goods_id)->value('saller_id');
                $data = [
                    'user_id' => $uid,
                    'goods_id' => $goods_id,
                    'buy_number' => $goods_number,
                    'goods_name' => $goods->goods_name,
                    'add_time' => time(),
                    'goods_price' => $goods->goods_price,
                    'specs_id' => $goods_attr_id??'',
                    'saller_id' => $saller_id,
                ];
                $res = CartModel::insert($data);
//            dd($res);
            }
            if ($res) {
                return json_encode(['code' => '0000', 'msg' => "加入购物车成功"]);
            }
        }

    //购物车列表
    public  function  cart(){
//        $uid=1;
        $uid=request()->user_id;
        // print_r($uid);
        $cart=CartModel::select('cart.*','goods.goods_img')
            ->leftjoin('goods','goods.goods_id','=','cart.goods_id')
            ->where(['user_id'=>$uid])
            ->get();
        // dump(123);
    //    dd($cart);
        $specs_name_model=new Specsname_Model();
        $specs_val_model=new Specsval_Model();
        foreach($cart as $k=>$v){
            $data=[];
            if($v->specs_id){
                $specs_id=explode(':',$v->specs_id);
                foreach($specs_id as $kk=>$vv){
//                    dd($vv);
                    $data[]=explode(',',$vv);
                    foreach($data as $kkk=>$vvv){
                        $data[$kkk]['specs_id']=$vvv[0];
                        $data[$kkk]['specs_name']=$specs_name_model->where('specs_id',$vvv[0])->value('specs_name');
                        $data[$kkk]['specs_val_id']=$vvv[1];
                        $data[$kkk]['specs_val']=$specs_val_model->where('id',$vvv[1])->value('specs_val');
                    }
                    $cart[$k]['specs']=$data;
                }
            }
        }
        // dd($cart);
        return json_encode($cart,true);
    }

    #结算
    public  function  settl(){
        $uid=request()->user_id;
//        $uid=1;
        $cart_id=request()->cart_id;
        $cart_id = explode(',',$cart_id);
        $address=AddressModel::where('user_id',$uid)->get();
        $cartinfo=CartModel::select('cart.*','goods.goods_img')
                ->leftjoin('goods','goods.goods_id','=','cart.goods_id')
                ->whereIn('cart_id',$cart_id)
                ->get();
    //    dd($address);
        $total=0;
        $specs_name_model=new Specsname_Model();
        $specs_val_model=new Specsval_Model();
        $date=[];
        foreach($cartinfo as $k=>$v){
            if($v->specs_id){
                $specs_id=explode(':',$v->specs_id);
                foreach($specs_id as $kk=>$vv){
                    $date[]=explode(',',$vv);
                    foreach($date as $kkk=>$vvv){
                        $date[$kkk]['specs_id']=$vvv[0];
                        $date[$kkk]['specs_name']=$specs_name_model->where('specs_id',$vvv[0])->value('specs_name');
                        $date[$kkk]['specs_val_id']=$vvv[1];
                        $date[$kkk]['specs_val']=$specs_val_model->where('id',$vvv[1])->value('specs_val');
                    }
                    $cartinfo[$k]['specs']=$date;
                }
            }
           $v['xiaoji']= $v['buy_number']*$v['goods_price'];
            $total+=$v['buy_number']*$v['goods_price'];
        }
        return json_encode(['code'=>'0001','msg'=>"成功",'data'=>['address'=>$address,'cartinfo'=>$cartinfo,'total'=>$total]]);
    }
    //地址
    public  function  getorder(){
        $data=request()->all();
        $uid=1;
        $data['is_moren']=1;
        $uid = $data['user_id'];
//        dd($data);
        if($data['is_moren']==1){
            $res=AddressModel::where('user_id',$uid)->update(['is_moren'=>2]);
        }
//        $uid=$data['user_id'];
        $res=AddressModel::where('user_id',$uid)->update(['is_moren'=>2]);
        $address=AddressModel::insert($data);
        if($address){
            return json_encode(['code'=>'0000','msg'=>"添加收货地址成功",'data'=>[]]);
        }
    }
    //秒杀
    public function api_kill(){
        $cate = CateModel::where(["pid"=>0])->limit(6)->get();
        $kill = KillModel::leftjoin("goods","kill.goods_id","=","goods.goods_id")->get();
        $data = ["cate"=>$cate,"kill"=>$kill];
        return $data;
    }

    public function cut(){
        $cate = CateModel::where(["pid"=>0])->limit(6)->get();
        $data = ["cate"=>$cate];
        return $data;
    }

    public function cut_show(){
        $cate = CateModel::where(["pid"=>0])->limit(6)->get();
        $data = ["cate"=>$cate];
        return $data;
    }

    public function home(){
        $cate_cate = CateModel::get();
        $cate = CateModel::where(["pid"=>0])->limit(6)->get();
        $data = GoodsModel::where(["goods_status"=>1,"is_del"=>1,"is_shelf"=>1])->limit(6)->get()->toArray();
        $info = $this->GetIndo($cate_cate);
        $data = ["cate"=>$cate,"data"=>$data,"info"=>$info];
        return $data;
    }
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

    public function user_home(){
        $cate = CateModel::where(["pid"=>0])->limit(6)->get();
        $data = ["cate"=>$cate];
        return $data;
    }

    public function daifukuan(){
        $cate = CateModel::where(["pid"=>0])->limit(6)->get();
        $data = ["cate"=>$cate];
        return $data;
    }

    public function daifahuo(){
        $cate = CateModel::where(["pid"=>0])->limit(6)->get();
        $data = ["cate"=>$cate];
        return $data;
    }

    public function daishouhuo(){
        $cate = CateModel::where(["pid"=>0])->limit(6)->get();
        $data = ["cate"=>$cate];
        return $data;
    }

    public function daipingjia(){
        $cate = CateModel::where(["pid"=>0])->limit(6)->get();
        $data = ["cate"=>$cate];
        return $data;
    }

    //头部导航
    public function searchnav(){
        $callback=request()->callback;
        $val=request()->search_val;
        // dd($val);
        $goods=GoodsModel::where('goods_name','like',"%$val%")->orderby('goods_id','desc')->pluck('goods_id')->first();
        // dd($goods);
        if($goods){
            $arr = json_encode(['code'=>'0000','goods_id'=>$goods]);
        }else{
            $arr = json_encode(['code'=>'0001','msg'=>'未查询到此商品']);
        }
        // echo $callback.'('.$goods.')';die;
        echo $callback.'('.$arr.')';exit;
    } 
    //购物车导航
    public function cartnav(){
        $callback=request()->callback;
        $val=request()->search_val;
        // dd($val);
        $cart=CartModel::where('goods_name','like',"%$val%")->orderby('cart_id','desc')->pluck('goods_id')->first();
        // dd($cart);
        if($cart){
            $arr = json_encode(['code'=>'0000','goods_id'=>$cart]);
        }else{
            $arr = json_encode(['code'=>'0001','msg'=>'未查询到此商品']);
        }
        // echo $callback.'('.$goods.')';die;
        echo $callback.'('.$arr.')';exit;

    }
    //取消订单
    public function nopay(){
        $callback=request()->callback;
        $order_goods_id=request()->order_goods_id;
        $res = OrderGoodsModel::where('order_goods_id',$order_goods_id)->update(['is_del'=>'2']);
        if($res===false){
            $arr = json_encode(['code'=>'0000','msg'=>'取消失败']);
        }else{
            $arr = json_encode(['code'=>'0000','msg'=>'取消成功']);
        }
        echo $callback.'('.$arr.')';exit;
    }
}
