<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name'=>'first',
                'image'=> fake()->imageUrl('60','60'),
            ],
            [
                'name'=>'second',
                'image'=> fake()->imageUrl('60','60'),
            ],
            [
                'name'=>'thirs',
                'image'=> fake()->imageUrl('60','60'),
            ],
            [
                'name'=>'any',
                'image'=> fake()->imageUrl('60','60'),
            ],
        ]);
    }
}
