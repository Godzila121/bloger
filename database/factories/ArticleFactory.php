<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'topic_id' => Topic::inRandomOrder()->first()->id ?? Topic::factory(),
            'title' => $this->faker->sentence,
            'slug' => Str::slug($this->faker->unique()->sentence),
            'summary' => $this->faker->paragraph,
            'content' => $this->faker->paragraphs(3, true),
            'is_premium' => false,
        ];
    }

    public function premium(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'is_premium' => true,
            ];
        });
    }
}
