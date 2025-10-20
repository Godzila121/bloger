@extends('layouts.app')

@section('content')
<section class="hero">
    <div class="hero-card">
        <h1>Все про плавання: від техніки до персональних планів</h1>
        <p>Покрокові уроки, вправи для сили та витривалості. Платна підписка дає доступ до персональних програм і консультацій.</p>
        <div class="features">
            <div class="feature">Уроки для початківців</div>
            <div class="feature">Покращення техніки</div>
            <div class="feature">Тренування на швидкість</div>
        </div>
    </div>
    <aside class="hero-card" aria-label="Поточні рейтинги">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px">
            <div style="font-weight:800">Рейтинг статей</div>
            <div class="pill">Топ</div>
        </div>
        <div style="display:flex;flex-direction:column;gap:10px">
            {{-- Використовуємо $articles->take(3), щоб уникнути помилки, якщо статей менше 3 --}}
            @foreach($articles->take(3) as $article)
                <div style="display:flex;justify-content:space-between;align-items:center">
                    <div><strong>{{ Str::limit($article->title, 25) }}</strong><div class="muted" style="font-size:13px">{{ $article->topic->name }}</div></div>
                    {{-- Перевіряємо, чи є рейтинги, перед тим як рахувати середнє --}}
                    <div class="muted">{{ $article->ratings->avg('score') ? number_format($article->ratings->avg('score'), 1) : 'N/A' }} ★</div>
                </div>
            @endforeach
        </div>
    </aside>
</section>

<section class="grid">
    <main>
        <div class="card">
            {{-- ОСЬ БЛОК, ЯКИЙ МИ ДОДАЛИ --}}
            @auth
                <div style="display: flex; justify-content: flex-end; margin-bottom: 1rem;">
                    <a href="{{ route('articles.create') }}" class="btn" style="text-decoration: none; color: white;">
                        Створити статтю
                    </a>
                </div>
            @endauth

            <h2 style="margin:0 0 1rem;">Довідник по плаванню</h2>

            @forelse($articles as $index => $article)
                {{-- Виправляємо посилання на slug, як у ваших маршрутах --}}
                <a href="{{ route('articles.show', $article->slug) }}" class="lesson" style="text-decoration:none; color: inherit; margin-top: {{ $index > 0 ? '16px' : '0' }}; display: flex;">
                    <div class="thumb">{{ $index + 1 }}</div>
                    <div>
                        <h3>{{ $article->title }}</h3>
                        {{-- Використовуємо summary, якщо є, або обрізаємо content --}}
                        <p>{{ $article->summary ?? Str::limit($article->content, 100) }}</p>
                    </div>
                </a>
            @empty
                <p>Статей ще немає.</p>
            @endforelse
        </div>
    </main>
    <aside>
        <div id="subscribe" class="card">
            <h3 style="margin-top:0">Підписка на поради</h3>
            <p class="muted">Отримайте індивідуальні тренування та аналіз техніки від професіоналів.</p>
            <div class="plan" style="margin-top: 1rem;">
                <div style="font-weight:800">Профі</div>
                <div class="muted">$9.99/міс • 2 консультації + аналіз</div>
            </div>
<a class="btn" href="{{ route('subscriptions.index') }}" style="margin-top: 1rem; text-align:center; width: 100%;">Оформити підписку</a>        </div>
        <div class="card">
            <h4 style="margin-top:0">Поширені питання</h4>
            <details style="margin-bottom:8px"><summary>Як відмінити підписку?</summary><div style="margin-top:8px" class="muted">У налаштуваннях вашого профілю.</div></details>
            <details><summary>Чи підходять плани для професіоналів?</summary><div style="margin-top:8px" class="muted">Так, ми пропонуємо просунуті пакети.</div></details>
        </div>
    </aside>
</section>
@endsection
