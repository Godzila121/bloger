<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // ЦЕ ВАШ ОРИГІНАЛЬНИЙ МЕТОД INDEX. ВІН ПРАВИЛЬНИЙ.
   public function index()
   {
       // Тепер ми завантажуємо 'topic', 'user', і 'ratings'
       $articles = Article::with('topic', 'user', 'ratings')->latest()->paginate(10);
       return view('articles.index', compact('articles'));
   }

    // ЦЕ НОВИЙ МЕТОД ДЛЯ ВІДОБРАЖЕННЯ ФОРМИ
    public function create()
    {
        // Завантажуємо всі теми з бази даних
        $topics = \App\Models\Topic::all();
        // Передаємо їх у вигляд (view)
        return view('articles.create', compact('topics'));
    }

    // ЦЕ НОВИЙ МЕТОД ДЛЯ ЗБЕРЕЖЕННЯ СТАТТІ
   public function store(Request $request)
   {
       $request->validate([
           'title' => 'required|max:255',
           'content' => 'required',
           'topic_id' => 'required|exists:topics,id', // <-- Додали валідацію
           'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           'is_premium' => 'boolean',
       ]);

       $article = new Article($request->all()); // <-- Тепер можна передавати все
       $article->is_premium = $request->has('is_premium');
       $article->user_id = auth()->id();

       $slug = \Illuminate\Support\Str::slug($request->title);
       $count = \App\Models\Article::where('slug', 'LIKE', "{$slug}%")->count();
       $article->slug = $count > 0 ? "{$slug}-{$count}" : $slug;

       if ($request->hasFile('image')) {
           $path = $request->file('image')->store('images', 'public');
           $article->image = $path;
       }

       $article->save();

       return redirect()->route('articles.index')
                       ->with('success','Статтю успішно створено!');
   }

    // ЦЕ ВАШ ОРИГІНАЛЬНИЙ МЕТОД SHOW. ВІН ПРАВИЛЬНИЙ.
    public function show(Article $article)
    {
        $article->load('comments.user', 'ratings');

        if ($article->is_premium && !(auth()->check() && auth()->user()->hasActiveSubscription())) {
            return redirect()->route('subscriptions.index')->with('error', 'This is premium content. Please subscribe to view.');
        }

        return view('articles.show', compact('article'));
    }
}
