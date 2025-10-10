<?php

namespace Database\Factories;

use App\Models\Rating;
use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory
{
    protected $model = Rating::class;

    public function definition(): array
    {
        return [
            'article_id' => Article::factory(),
            'user_id' => User::factory(),
            'score' => $this->faker->numberBetween(1, 5),
        ];
    }
}
