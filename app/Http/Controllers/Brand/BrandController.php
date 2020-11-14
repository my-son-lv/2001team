<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand_Model;
class BrandController extends Controller
{
    public function brand(){

return view("admin.brand.admin_brand");
    }

    public function brand_do(){
        $data = request()->all();
        $Brand_Model = new Brand_Model();
        $Brand_Model->brand_save($data);//调用Model的brand_save
    }
}
