<?php

namespace App\Http\Controllers\Goods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand_Model;
use App\Models\Specsname_Model;
use App\Models\Specsval_Model;
class GoodsController extends Controller
{
    /**
     * 后台商品添加
     */
    public function create(){
        $brand_info= Brand_Model::where('is_del',1)->get();
        $specs_name_model = new Specsname_Model();
        $specs_val_model = new Specsval_Model();
        $specs_name_info = $specs_name_model->specs_name_info();
        $specs_val_info = $specs_val_model->specs_value_info();
//        dd($specs_val_info);
        return view('admin.goods.create',['brand_info'=>$brand_info,'specs_name_info'=>$specs_name_info,'specs_val_info'=>$specs_val_info]);
    }
    /**
     * 后台商品图片的添加方法
     */
    public function upload(Request $request){
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $photo = $request->file;
            $store_result = $photo->store('upload');
            //return $this->success(['msg'=>'上传成功','data'=>env('UPLOADS_URL').$store_result]);
            //return json_encode(['code'=>0,'msg'=>'上传成功','data'=>env('UPLOADS_URL').$store_result]);
            // dd(env('UPLOADS_URL').$store_result);
            // return $this->success('上传成功',env('UPLOADS_URL').$store_result);
            $arr = [
                'code'=>'0000',
                'data'=>['url'=>env('JUSTME_URL'),'urls'=>$store_result]
            ];
            return $arr;
        }
            return $this->error('上传失败');
    }
    /**
     * 后台商品添加相册的添加方法
     */
    public function uploads(Request $request){
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $photo = $request->file;
            $store_result = $photo->store('upload');
            //return $this->success(['msg'=>'上传成功','data'=>env('UPLOADS_URL').$store_result]);
            //return json_encode(['code'=>0,'msg'=>'上传成功','data'=>env('UPLOADS_URL').$store_result]);
            // dd(env('UPLOADS_URL').$store_result);
            // return $this->success('上传成功',env('UPLOADS_URL').$store_result);
            $arr = [
                'code'=>'0000',
                'data'=>['url'=>env('JUSTME_URL'),'urls'=>$store_result]
            ];
            return $arr;
        }
            return $this->error('上传失败');
    }
    /**
     * 后台添加 中添加规格
     */
    public function specs(Request $request){
        $specs_name = $request->specs_name;
        $specs_val = $request->specs_val;
        $specs_name_model = new Specsname_Model();
        $specs_val_model = new Specsval_Model();
        $specs_id = $specs_name_model->specs_name_id($specs_name);
        if(!$specs_id){
            $data = [
                'add_time'=>time(),
                'specs_name'=>$specs_name
            ];
            $specs_id = $specs_name_model->specs_name_create($data);
        }
        $str = $specs_val_model->specs_value_id($specs_id,$specs_val);
        if(!$str){
            $specs_val_model->specs_value_create(['specs_id'=>$specs_id,'specs_val'=>$specs_val,'add_time'=>time()]);
        }
        return ['code'=>0000,'msg'=>'成功','data'=>[]];
    }
    /**
     * 后台添加 商品下规格
     */
    public function specs_create(){
        $sku = request()->sku;
        $arr = $this->sku_manage($sku);
        $data = [
            'success'=>true,
            'msg'=>'成功',
            'data'=>$arr
        ];
        return json_encode($data,true);
    }

    /**
     * @param $sku
     * 商品下规格的处理
     */
    public function sku_manage($sku){
        //定义空数组
        $arr = [];
        //把传过来的数组去掉为null的转换为数组
        foreach(array_filter($sku) as $k=>$v){
            //去掉右侧的逗号
            $dat = rtrim($v,',');
            //把字符串转换为数组
            $form = explode(',',$dat);
            //把数组转移到$arr中
            $arr[$k] = $form;
        }
        //定义空数组
        $data = [];
        //把上面的数组进行循环（三维数组）
        foreach($arr as $key=>$value){
            $tmp = [];
            //循环进行二维数组
            foreach($value as $kk=>$vv){
                //换成规格名称对规格值的形式
                $str = "$key:$vv";
                array_push($tmp,$str);
            }
            //保存到一个新的数组中
            array_push($data,$tmp);
        }

        $data = $this->loop($data);
//        dd($data);
        //定义空数组
        $arr5 = [];
        foreach($data as $k=>$v){
            $dat = explode(',',$v);
            $arr1 = [];
            $str = "";
            $id = "";
            foreach($dat as $kk=>$vv){
                $sxz = strstr($vv,":");
                $sxzs = ltrim($sxz,":");
                $sx = strstr($vv,":",true);
                //获取属性id
                $id .= $sx.",".$sxzs.":";
                $arr1["id"] = $id;
                //获取值_id
                //规格名称
                $specs_name = Specsname_Model::where('specs_id',$sx)->value('specs_name');
                //获取规格值
                $specs_val = Specsval_Model::where('id',$sxzs)->value('specs_val');
                //拼接规格名称和规格值
                $str.=$specs_name.'-'.$specs_val.":";
                $str = rtrim($str,',');
                $arr1['sku'] = $str;
            }
            $arr5[] = $arr1;
        }
        return $arr5;
    }
    public function loop($arr){
        $arr1 = array();
        $sku = array_shift($arr);
        while($arr2 = array_shift($arr)){
            $arr1 = $sku;
            $sku  = array();
            foreach($arr1 as $k=>$v){
                foreach($arr2 as $k2=>$v2){
                    $sku[] = $v.','.$v2;
                }
            }
        }
        return $sku;
    }
}
