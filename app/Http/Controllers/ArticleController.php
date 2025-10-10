<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('topic', 'user')->latest()->paginate(10);
        return view('articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        $article->load('comments.user', 'ratings');

        if ($article->is_premium && !(auth()->check() && auth()->user()->hasActiveSubscription())) {
            return redirect()->route('subscriptions.index')->with('error', 'This is premium content. Please subscribe to view.');
        }

        return view('articles.show', compact('article'));
    }
}
