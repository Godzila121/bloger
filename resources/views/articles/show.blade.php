@extends('layouts.app')

@section('title', $article->title)

@section('content')
<section class="grid">
    <main>
        <div class="card">
            <h1 style="font-size: 2.2rem; line-height: 1.2;">{{ $article->title }}</h1>
            <p class="muted">Тема: {{ $article->topic->name }}</p>
            <div style="margin-top: 2rem; font-size: 1.1rem; line-height: 1.6;">
                {!! $article->content !!}
            </div>
        </div>
    </main>
    <aside>
        <div id="comments" class="card">
            <h2 style="margin-top:0">Коментарі та рейтинг</h2>
            <div style="margin-bottom:10px; display:flex; gap: 8px; align-items: center;">
                <div style="font-weight:800">Рейтинг:</div>
                <div class="muted">{{ number_format($article->ratings->avg('score'), 1) }} ★ ({{ $article->ratings->count() }} відгуків)</div>
            </div>

            @forelse($article->comments as $comment)
                <div class="comment">
                    <div class="meta">
                        <div><strong>{{ $comment->user->name }}</strong></div>
                        <div>{{ $comment->created_at->diffForHumans() }}</div>
                    </div>
                    <div style="margin-top:8px">{{ $comment->content }}</div>
                </div>
            @empty
                <p class="muted">Ще немає коментарів.</p>
            @endforelse

            @auth
            <div style="margin-top:16px">
                <h3>Залишити відгук</h3>
                <form action="{{ route('comments.store', $article) }}" method="POST">
                    @csrf
                    <textarea name="content" placeholder="Ваш відгук" required></textarea>
                    <button class="btn" type="submit" style="margin-top:8px">Надіслати</button>
                </form>
            </div>
            @endauth
        </div>
    </aside>
</section>
@endsection
