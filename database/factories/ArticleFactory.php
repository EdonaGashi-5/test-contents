<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        $categories = Category::all()->random()->pluck('id');
        

        return [
            'title' => $this->faker->unique()->word,
            'abstract' => $this->faker->paragraph,
            'contents' => $this->faker->text(500),
            'status' => 1,
            'author_id' => 1,
            'category_id' => $this->faker->randomElement($categories),
            'created_at' => now(),
            'updated_at' => now()
        ];

    }
}
