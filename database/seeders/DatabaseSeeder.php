<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Image;
use App\Models\Posts;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'ewar',
            'email' => 'alexanderovelar4@gmail.com',
            "password"=>"123",
            "role"=>"admin"
        ]);
        // Category::factory(5)->create();
        // $posts = Posts::factory(50)->create();




    }
}
