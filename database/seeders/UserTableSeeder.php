<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([


                'name' => 'zahraa',
                'email' => 'zahraa@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'image'=> fake()->imageUrl('60','60'),
                'remember_token' => '',
                'is_admin' => 0,
                'blocked' => 0


        ]);
    }
}
