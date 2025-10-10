<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Topic;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Rating;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $styles = ['Freestyle', 'Breaststroke', 'Backstroke', 'Butterfly'];
        foreach ($styles as $style) {
            Topic::create([
                'name' => $style,
                'slug' => Str::slug($style),
                'description' => "All about {$style} swimming.",
            ]);
        }

        Article::factory(10)->create(['user_id' => $user->id]);
        Article::factory(5)->premium()->create(['user_id' => $user->id]);

        Article::all()->each(function ($article) use ($user) {
            Comment::factory(3)->create([
                'article_id' => $article->id,
                'user_id' => $user->id,
            ]);
            Rating::factory()->create([
                'article_id' => $article->id,
                'user_id' => $user->id,
            ]);
        });
    }
}
