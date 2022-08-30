<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=> $this->faker->name(),
            'slug' => $this->faker->name(),
            'image' => $this->faker->image('public/upload/article',640,480, null, false),
            'summary',
            'description',
            'type'=> rand(1,3),
            'position',
            'status',
            'url',
            'is_active',
            'category_id',
            'meta_description',
        ];
    }
}
