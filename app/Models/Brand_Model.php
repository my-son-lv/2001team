<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand_Model extends Model
{
    protected $table="brand";
    protected $primarKey="brand_id";
    public $timestamps=false;

    public function brand_save($data){
        unset($data["data"]);
        if(request()->hasFile($data["brand_logo"])){
            $file = request()->$data["brand_logo"];
            if($file->isValid()){
                $store_result = $file->store("uploads");
            }
        }
    }
}