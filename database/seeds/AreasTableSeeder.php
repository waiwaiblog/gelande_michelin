<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('areas')->delete();

        DB::table('areas')->insert([
           ['area_name' => '北海道', 'id' => 1],
           ['area_name' => '東北', 'id' => 2],
           ['area_name' => '関東', 'id' => 3],
           ['area_name' => '甲信越', 'id' => 4],
           ['area_name' => '東海', 'id' => 5],
           ['area_name' => '北陸', 'id' => 6],
           ['area_name' => '近畿', 'id' => 7],
           ['area_name' => '中国', 'id' => 8],
           ['area_name' => '四国', 'id' => 9],
           ['area_name' => '九州', 'id' => 10],
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Model::reguard();
    }
}
