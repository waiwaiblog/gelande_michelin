<?php

use Illuminate\Database\Seeder;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reviews')->insert([
            'title' => 'ドピーカン',
            'star' => 3,
            'comment' => 'とても気持ちいい滑り。',
            'user_id' => 1,
            'area_id' => 2,

        ]);
    }
}
