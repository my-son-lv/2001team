<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsImgsModel extends Model
{
    protected $table="goods_imgs";
    protected $primarKey="imgs_id";
    public $timestamps=false;

    public function goods_imgs_create($data){
        return GoodsImgsModel::insertGetId($data);
    }
    public function goods_imgs_get($goods_id){
        return GoodsImgsModel::where('goods_id',$goods_id)->get();
    }
}
