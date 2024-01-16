<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserTableSeeder::class);
        \App\Models\User::factory(1)->create();

        $this->call(TagsTableSeeder::class);
        \App\Models\Tag::factory(5)->create();

        $this->call(CategoriesTaleSeeder::class);

    }
}
