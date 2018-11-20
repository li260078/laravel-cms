<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(['大吉大利','今晚吃鸡','王者荣耀','英雄联盟','IG牛逼'] as $v){
            DB::table('categories')
                ->insert([
                    'title' => $v,
                    'icon' => 'fa fa-bar-chart-o',
                ]);
        }
    }
}
