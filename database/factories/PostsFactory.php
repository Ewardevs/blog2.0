<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


class PostsFactory extends Factory
{
protected $model = Posts::class;
    public function definition(): array
    {
        return [
            "title"=> $this->faker->sentence,
            "body"=> $this->faker->text(6000),
            "category_id"=> Category::all()->random()->id,
            "slug"=> $this->faker->slug,
            "image"=> "/storage/posts/img.jpeg",
            "user_id"=> User::all()->random()->id,
        ];
    }
}
