<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImgsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('goods_imgs')->insert([
            'goods_id' => rand(1,53),
            'goods_imgs' => 'upload/2d21Vp6HHaCqDR0au2ZhJafpPwYyrD4GYtLczUc6.jpeg',
            'goods_title' => 'title',
            'add_time' => time(),
        ]);
    }
}
