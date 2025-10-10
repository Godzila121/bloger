<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request, Article $article)
    {
        $request->validate(['score' => 'required|integer|min:1|max:5']);

        $article->ratings()->updateOrCreate(
            ['user_id' => auth()->id()],
            ['score' => $request->score]
        );

        return back()->with('success', 'Thank you for your rating!');
    }
}
