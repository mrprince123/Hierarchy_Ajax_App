<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@admin.com',
                'role' => 'admin',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Employee User',
                'email' => 'employee@employee.com',
                'role' => 'employee',
                'password' => bcrypt('123456'),
            ]
        ];

        foreach($users as $key =>$user){
            User::create($user);
        }
    }
}
