<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsModel extends Model
{
    protected $table="goods";
    protected $primarKey="goods_id";
    public $timestamps=false;

    public function goods_create($data){
        return GoodsModel::insertGetId($data);
    }
    public function goods_infos($saller_id){
        return GoodsModel::where(['is_del'=>1,'saller_id'=>$saller_id])->paginate(4);
    }
    public function goods_info(){
        return GoodsModel::where(['is_del'=>1,'goods_status'=>0])->paginate(10);
    }
    public function goods_del($goods_id){
        return GoodsModel::where('goods_id',$goods_id)->update(['is_del'=>2,'upd_time'=>time()]);
    }
    public function goods_first($goods_id){
        return GoodsModel::where('goods_id',$goods_id)->first();
    }
    public function goods_update($goods_id,$data){
        return GoodsModel::where('goods_id',$goods_id)->update($data);
    }
    public function goods_exam_true($goods_id,$res){
        return GoodsModel::where('goods_id',$goods_id)->update(['goods_status'=>$res]);
    }
}
