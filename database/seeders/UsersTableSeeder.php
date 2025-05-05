<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            //Admin
            [
                'name' => 'Admin',
                'username' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),//password
                'role' => 'admin',
                'status' => 'Active',
            ],
            //User
            [
                'name' => 'Ronald',
                'username' => 'Ronald',
                'email' => 'user@gmail.com',
                'password' => Hash::make('password'),//password
                'role' => 'user',
                'status' => 'Active',
            ],

        ]);
    }
}
