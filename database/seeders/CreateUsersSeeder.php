<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'is_admin' => "1",
                'password' => bcrypt('1234'),
                'num_position' => '1234',
                'position' => 'เจ้าหน้าที่พัสดุ',
                'department' => 'พัสดุ',
                'task' => 'งานพัสดุ'
            ],
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'is_admin' => "0",
                'password' => bcrypt('1234'),
                'num_position' => '2213',
                'position' => 'ทดสอบ',
                'department' => 'ทดสอบ',
                'task' => 'ทดสอบ'
            ]
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}