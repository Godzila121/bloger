<!DOCTYPE html>
<html>
<head>
    <title>Swimming Handbook</title>
</head>
<body>
    <h1>Swimming Handbook</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    @foreach($articles as $article)
        <article>
            <h2><a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a></h2>
            <p><em>By {{ $article->user->name }} in {{ $article->topic->name }}</em></p>
            <p>{{ $article->summary }}</p>
            @if($article->is_premium)
                <p><strong>(Premium)</strong></p>
            @endif
        </article>
    @endforeach

    {{ $articles->links() }}
</body>
</html>
