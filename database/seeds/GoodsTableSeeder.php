<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('goods')->insert([
            'goods_name' => 'LV',
            'goods_price' => rand(100,100000),
            'brand_id' => rand(1,5),
            'cate_id' => rand(1,49),
            // 'cate_id' => '6',
            'content' => '很好',
            'goods_img' => 'upload/2d21Vp6HHaCqDR0au2ZhJafpPwYyrD4GYtLczUc6.jpeg',
            'goods_number' => rand(1000,100000),
            'add_time' => time(),
            'goods_article' => Str::random(30),
        ]);
    }
}
