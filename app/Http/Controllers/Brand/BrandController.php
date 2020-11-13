<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand_Model;
class BrandController extends Controller
{
    public function brand(){
        echo 123;
        $max = 100;
        $num = 10;
        $sum = 0;
        $count = 0;
        while($sum<$max){
            $surNum = $num-$count;
            $rand = mt_rand(1,($max-$sum-$surNum)+1);
            $sum += $rand;
            $count++;
            echo $rand."<br/>";
        }
        echo $sum;
//return view("admin.brand.admin_brand");
    }

    public function brand_do(){
        $data = request()->all();
        $Brand_Model = new Brand_Model();
        $Brand_Model->brand_save($data);//调用Model的brand_save
    }
}
