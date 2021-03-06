<?php

namespace App\Http\Controllers\Index;
use App\Http\Controllers\Controller;
use App\Models\AddressModel;
use App\Models\CartModel;
use App\Models\GoodsModel;
use App\Models\OrderGoodsModel;
use App\Models\OrderModel;
use App\Models\SpecsModel;
use App\Models\Area;
use App\Models\BargModel;
use App\Models\SallerInfoModel;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redis;


class CartController extends Controller
{
    //获取用户id
    public function uid(){
//        dd(123);
        if(!isset($_COOKIE['token'])){
             return json_encode(['code'=>'0003','msg'=>"请登录"]);
//            return  redirect('/login')->withErrors(['请登录']);
        }else{
             $uid=Redis::Hget('token',$_COOKIE['token']);
            return $uid;
        }
    }

    public function  addcart(){
        $uid=1;
//        $uid=$this->uid();
//        dd($uid);
//        $uid=1;
        $uid=$this->uid();
        if(strpos($uid,'{')!==false){
            return json_encode(['code'=>'0003','msg'=>"请登录"]);
        }
        $goods_id = request()->goods_id;
        $goods_number = request()->goods_number;
        $goods_attr_id = request()->goods_attr_id;
//         dd($goods_attr_id);
        $url=env('API_URL')."api/index/addcart";
        $cart=$this->postcurl($url,['goods_id'=>$goods_id,'goods_number'=>$goods_number,'goods_attr_id'=>$goods_attr_id,'uid'=>$uid]);
        // dd($cart);
        return json_encode($cart);
    }

    //购物车列表
    public function cart(){
        $uid=1;
//        $uid=$this->uid();
        // dd($uid);
        $url=env('API_URL')."api/index/cart";
        // dd($url);
        $cart=$this->postcurl($url,['user_id'=>$uid]);
        // dump(12312312);
        // dd($cart);
        $data = [];
        foreach($cart as $k=>$v){
//            dd($v);
            $data[] = $v['saller_id'];
        }
        $data = array_unique($data);
        // dd($data);
        $goods=GoodsModel::where("is_hot",1)->limit(4)->get();
        $sallerinfo=SallerInfoModel::select('saller_id','saller_name')->whereIn('saller_id',$data)->get();
            if($sallerinfo){
                $sallerinfo = $sallerinfo->toArray();
            }
        $res = count($sallerinfo);
        $sallerinfo[$res]['saller_id'] = 0;
        $sallerinfo[$res]['saller_name'] = '品优购自营';
        // dump($sallerinfo);
        return view("index.cart.cart",['cart'=>$cart,'goods'=>$goods,'sallerinfo'=>$sallerinfo]);
    }
    //结算页
    public function settl(){
//        $uid=$this->uid();
        $uid=1;
        $cart_id=request()->cart_id;
//        $area=Area::where('pid','0')->get();
        $url=env('API_URL')."api/index/settl";
        $cart=$this->postcurl($url,['user_id'=>$uid,'cart_id'=>$cart_id]);
        return view("index.cart.settl",['cart'=>$cart['data']['address'],'cartinfo'=>$cart['data']['cartinfo'],'total'=>$cart['data']['total']]);
    }
        //收货地址添加
    public  function  getorder(){
        $uid=1;
//        $uid=$this->uid();
        $uid=$this->uid();
        $data=request()->all();
        $data['user_id']=$uid;
        // dd($data);
        $url=env('API_URL')."api/index/getorder";
        $cart=$this->postcurl($url,$data);
        // dd($cart);
        return json_encode($cart,true);
    }

    //删除收货地址
    public  function  orderdel(){
        $address_id=request()->address_id;
        $address=AddressModel::where("address_id",$address_id)->delete();
        if($address){
            return json_encode(['code'=>'0000','msg'=>"删除成功"]);
        }
    }

        //默认地址
    public function is_moren()
    {
        $uid = 1;
        $address_id = request()->address_id;
        $res = AddressModel::where(['user_id' => $uid, 'address_id' => $address_id, 'is_del' => 1])->update(['is_moren' => 2]);
        if ($res) {
            return json_encode(['code' => '0000', 'msg' => "设置成功"]);
        }
    }

    #+
    public  function  getTypePrice(){
        $type=request()->type;
        $cart_id=request()->cart_id;
        $buy_number=request()->buy_number;

        $cart=CartModel::select('specs_id','buy_number','goods_id')->where('cart_id',$cart_id)->first();
        if($type=='+'){
            if($cart->specs_id){
                $specs_number=SpecsModel::select('goods_number')->where(['goods_id'=>$cart['goods_id'],'specs'=>$cart['specs_id']])->first();
                if($buy_number>=$specs_number['goods_number']){
                    $buy_number=$specs_number['goods_number'];
                    return json_encode(['code'=>'0001','data'=>$buy_number,'msg'=>'已购买最大库存量!!!']);
                }else{
//                    dd(456);
                    $buy_number=$buy_number+1;
                }
                return $this->getNumberPrice($cart_id,$buy_number);
            }else{
                $goods_number=GoodsModel::where('goods_id',$cart['goods_id'])->value('goods_number');
                if($buy_number>=$goods_number){
                    $buy_number=$goods_number;
                    return json_encode(['code'=>'0001','data'=>$buy_number,'msg'=>'已购买最大库存量']);

                }else{
//                    dd(111);
                    $buy_number=$goods_number+1;
                }
                return $this->getNumberPrice($cart_id,$buy_number);
            }
        }
    }
    //-
    public  function  getTypePrices(){
        $type=request()->type;
        $cart_id=request()->cart_id;
        $buy_number=request()->buy_number;
        $cart=CartModel::select('specs_id','buy_number','goods_id')->where('cart_id',$cart_id)->first();
        if($cart->specs_id){
            $specs_number=SpecsModel::select('goods_number')->where(['goods_id'=>$cart['goods_id'],'specs'=>$cart['specs_id']])->first();
            if($buy_number>1){
                $buy_number=$buy_number-1;
            }else{
                $buy_number=1;
            }
            return $this->getNumberPrice($cart_id,$buy_number);
        }else{
            $goods_number=GoodsModel::select('goods_number')->where(['goods_id'=>$cart['goods_id']])->first();
            if($buy_number>1){
                $buy_number=$buy_number-1;
            }else{
                $buy_number=1;
            }
            return $this->getNumberPrice($cart_id,$buy_number);
        }
    }

    //文本框
    public  function  getInputPrice(){
        $buy_number=request()->buy_number;
        $cart_id=request()->cart_id;
        $cart=CartModel::select('specs_id','buy_number','goods_id')->where('cart_id',$cart_id)->first();
        if($cart->specs_id){
            //规格
            $specs_number=SpecsModel::select('goods_number')->where(['goods_id'=>$cart['goods_id'],'specs'=>$cart['specs_id']])->first();
            if($buy_number>=$specs_number['goods_number']){
                $buy_number=$specs_number['goods_number'];
                return json_encode(['code'=>'0001','data'=>$buy_number,'msg'=>'已超出库存量!!!']);
            }
        }else{
            $goods_number=GoodsModel::select('goods_number')->where(['goods_id'=>$cart['goods_id']])->first();
            if($buy_number>$goods_number['goods_number']){
                $buy_number=$goods_number['goods_number'];
                return json_encode(['code'=>'0001','data'=>$buy_number,'msg'=>'已超出库存量']);

            }
        }
        if(!preg_match("/^[1-9][0-9]*$/",$buy_number)){
            return json_encode(['code'=>'0001','msg'=>"参数错误"]);
        }
        if(!$cart_id){
            return json_encode(['code'=>'0001','msg'=>"参数错误"]);
        }
        return $this->getNumberPrice($cart_id,$buy_number);

    }

    //单删
    public  function  del(){
        $cart_id=request()->cart_id;
        $cart=CartModel::where("cart_id",$cart_id)->delete();
        if($cart){
            return json_encode(['code'=>'0000',"msg"=>"删除成功"]);
        }
    }

    public  function  cart_del(){
        $cart_id=request()->cart_id;
        $cart=CartModel::whereIn("cart_id",$cart_id)->delete();
        if($cart){
            return json_encode(['code'=>'0000','msg'=>"删除成功"]);
        }else{
            return json_encode(['code'=>'0001','msg'=>"删除失败"]);

        }
    }

    //复选框
    public  function  manydel(){
        $cart_id = request()->cart_id;
        if(!count($cart_id)){
            return json_encode(['code'=>"0000",'msg'=>'ok','total'=>'0']);
        }
        $cart=CartModel::getprice($cart_id);
        if($cart){
            return json_encode(['code'=>"0000",'msg'=>'ok','total'=>$cart[0]]);
        }else{
            return json_encode(['code'=>"0000",'msg'=>'ok','total'=>'0']);
        }
    }

    public function getNumberPrice($cart_id,$buy_number){
        $res = CartModel::where('cart_id',$cart_id)->update(['buy_number'=>$buy_number]);
        if($res!==false){
            $cart = DB::select("select buy_number*goods_price as total from cart where cart_id in ($cart_id)");
            if($cart){
                return json_encode(['code'=>'0000','msg'=>'ok','total'=>$cart[0],'buy_number'=>$buy_number]);
//                return $this->success('ok',['total'=>$cart[0],'number'=>$buy_number]);
            }
        }
    }

    //订单页面
    public function order(){
        DB::beginTransaction();
        try {
            $uid = $this->uid();
            if(strpos($uid,',')!==false){
                return json_encode(['code'=>'0003','msg'=>"请登录"]);
            }
            // $uid=1;
            $data = request()->all();
            if(!isset($data['cart_id'])){
                return json_encode(['code'=>'0001','msg'=>'参数不全']);
            }
            $cart_id = $data['cart_id'];
            $data['user_id'] = $uid;
            $pay_name = ['2' => "支付宝"];
            $data['pay_name'] = $pay_name[$data['pay_type']];
            $data['order_sn'] = $this->createOrderSn();
            $cart_model = new CartModel();
            if(strpos($cart_id,',')!==false){
                $cart_id = explode(',',$cart_id);
                $array = [];
                // dd($cart_id);
                foreach($cart_id as $k=>$v){
                    $saller_id = $cart_model->where('cart_id',$v)->value('saller_id');
                    if(isset($array[$saller_id])){
                        $dat = $array[$saller_id].$v.',';
                    }else{
                        $dat = $v.',';
                    }
                    $array[$saller_id] = $dat;
                }
                //商家是$k    商家下面购物车id是$v
                foreach($array as $k=>$v){
                    $array[$k] = substr($v,strlen($v)-1,1);
                    if(strpos($v,',')!==false){
                        $array[$k] = explode(',',$v);
                    }
                    $aa = count($array[$k])-1;
                    unset($array[$k][$aa]);
                }
                $order_id = [];
                foreach($array as $k=>$v){
                        $data['cart_id'] = $v;
                        $data['saller_id'] = $k;
                        $bb= $this->order_create($data,$data['cart_id']);
                        array_push($order_id,$bb);
                        // $order_id+=$bb.',';
                        // dd($order_id);
                }
                // dd($order_id);
            }else{
                // dd(21432134134);
                $data['saller_id'] = $cart_model->where('cart_id',$data['cart_id'])->value('saller_id');
                $order_id = $this->order_create($data,$data['cart_id']);
            }
            // dd($order_id);
            if(is_array($order_id)){
                $order_id = implode(',',$order_id);
            }
            DB::commit();
            return json_encode(['code'=>'0000','msg'=>"ok",'url'=>env('JUSTMES_URL').'index/pay?order_id='.$order_id]);
        } catch (\Throwable $e) {
            dump($e->getMessage());
            DB::rollBack();
        }
        return view("index.order");
    }
    /**
     * 订单和订单商品表的添加
     */
    public function order_create($data,$cart_id){
        if ($data['address_id']) {
            $address = AddressModel::where("address_id", $data['address_id'])->first();
            $address = $address ? $address->toArray() : [];
        }
        // dd($cart_id);
        $total = CartModel::getprice($data['cart_id']);
        $data['goods_price'] = $total[0]->total;
        //订单
        $data['order_price'] = $data['goods_price'];
        $data['add_time'] = time();
        $data = array_merge($data, $address);
        unset($data['address_id']);
        unset($data['address_name']);
        unset($data['email']);
        unset($data['is_moren']);
        unset($data['cart_id']);
        unset($data['is_del']);
        unset($data['country']);
        //订单入库
        // dd($data);
        $order_id = OrderModel::insertGetId($data);
        if (is_string($cart_id)) {
            $cart_id = explode(',', $cart_id);
        }
        $goods = CartModel::whereIn('cart_id', $cart_id)->get();
        $goods = $goods ? $goods->toArray() : [];
    //  dd($goods);
        foreach ($goods as $k => $v) {
            $goods[$k]['order_id'] = $order_id;
            unset($goods[$k]['cart_id']);
            unset($goods[$k]['user_id']);
            unset($goods[$k]['add_time']);
            unset($goods[$k]['saller_id']);
            unset($goods[$k]['goods_img']);
        //   dd($goods);
        }
        // dd($goods);
        $order_goods = OrderGoodsModel::insert($goods);
        //订单商品入库
        $data['order_id'] = $order_id;
        // dd($order_goods);
        if ($order_goods) {
            CartModel::where("cart_id", $cart_id)->delete();
            foreach ($goods as $v) {
                if ($v['specs_id']) {
                    SpecsModel::where("specs", $v['specs_id'])->decrement('goods_number', $v['buy_number']);
                }
                GoodsModel::where('goods_id', $v['goods_id'])->decrement('goods_number', $v['buy_number']);
            }   
        }
        return $order_id;
    }

    //随机生成订单号
    public  function  createOrderSn(){
        $order_sn=date('YmdHis').rand(1000,9999);
        if($this->isHaveOrdersn($order_sn)){
            $this->createOrderSn();
        }
        return $order_sn;
    }

    //订单号出现的次数
    public  function  isHaveOrdersn($order_sn){

        return  OrderModel::where('order_sn',$order_sn)->count();
    }

    public function brag(){
        $url = "http://www.2001api.com/api/cut";
        $cate = $this->postcurl($url);
        $data = BargModel::leftjoin("goods","barg.goods_id","=","goods.goods_id")->get();
        return view("index.barg",["data"=>$data,"cate"=>$cate]);
    }//砍价模板

    public function brag_show(){
        $url = "http://www.2001api.com/api/cut_show";
        $cate = $this->postcurl($url);
        $data = BargModel::leftjoin("goods","barg.goods_id","=","goods.goods_id")->get();
        return view("index.barg",["data"=>$data,"cate"=>$cate]);
    }//砍价模板

    //API post curl
//初始化
    /**
     *
     * API post curl
     */
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
//        if(is_null(json_decode($result,true))){
//            return $result;
//        }
        return json_decode($result,true);
    }
}
