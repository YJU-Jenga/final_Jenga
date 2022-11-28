<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = [
            [
                'name' => '사용자',
                'email' => 'user@gmail.com',
                'password' => Hash::make('password'),
                'phone' => '010-1234-1234',
                'permission' => 0,
            ],
            [
                'name' => '관리자',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'phone' => '010-1234-1234',
                'permission' => 1,
            ]
        ];
        \Illuminate\Support\Facades\DB::table('users')->insert($users);
    }
}