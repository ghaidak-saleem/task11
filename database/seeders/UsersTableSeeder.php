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
            [
                'name'=>'ghaidak',
                'email'=>'ghaidak@gmail.com',
                'password'=> Hash::make('12345678'),
                'image'=> fake()->imageUrl('60','60'),
                'is_admin'=>'1',
            ],
            [
                'name'=>'ali',
                'email'=>'ali@gmail.com',
                'password'=> Hash::make('12345678'),
                'image'=> fake()->imageUrl('60','60'),
                'is_admin'=>'0',
            ]
        ]);
    }
}
