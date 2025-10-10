<!doctype html>
<html lang="uk">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>@yield('title', 'Плавання — Довідник та Тренування')</title>
    <meta name="description" content="Довідник по плаванню: поради, тренування, рейтинги та коментарі." />
    @vite('resources/css/app.css')
</head>
<body>
    <div class="wrap">
        <header>
            <a href="{{ route('articles.index') }}" class="logo" style="text-decoration: none; color: inherit;">
                <div class="mark">SW</div>
                <div>
                    <div style="font-weight:800">Плавання</div>
                    <div class="muted" style="font-size:13px">Довідник • Тренування</div>
                </div>
            </a>
            <nav class="nav">
                <a href="{{ route('articles.index') }}">Довідник</a>
                @auth
                    <a href="#">{{ auth()->user()->name }}</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="cta" style="border:none; cursor:pointer;">Вийти</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Увійти</a>
                    <a class="cta" href="{{ route('register') }}">Реєстрація</a>
                @endauth
            </nav>
        </header>

        @yield('content')

        <footer>
            © {{ date('Y') }} Плавання — Довідник.
        </footer>
    </div>
    @stack('scripts')
</body>
</html>
