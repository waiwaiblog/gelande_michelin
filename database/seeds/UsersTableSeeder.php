<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'user_name' => 'あああ',
                'email' => 'test@test.com',
                'password' => Hash::make('password123'),
            ],[
                'user_name' => 'いいい',
                'email' => 'test2@test.com',
                'password' => Hash::make('password123'),
            ]
        ]);
    }
}
