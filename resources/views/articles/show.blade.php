<!DOCTYPE html>
<html>
<head>
    <title>{{ $article->title }}</title>
</head>
<body>
    <h1>{{ $article->title }}</h1>
    <p><em>By {{ $article->user->name }} in {{ $article->topic->name }}</em></p>
    <div>{!! $article->content !!}</div>

    <hr>

    <h3>Ratings</h3>
    <p>Average rating: {{ $article->ratings->avg('score') }} / 5</p>
    @auth
    <form action="{{ route('ratings.store', $article) }}" method="POST">
        @csrf
        <select name="score">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <button type="submit">Rate</button>
    </form>
    @endauth

    <hr>

    <h3>Comments</h3>
    @foreach($article->comments as $comment)
        <div>
            <p><strong>{{ $comment->user->name }}</strong></p>
            <p>{{ $comment->content }}</p>
        </div>
    @endforeach

    @auth
    <form action="{{ route('comments.store', $article) }}" method="POST">
        @csrf
        <textarea name="content" rows="5" required></textarea>
        <button type="submit">Add comment</button>
    </form>
    @endauth
</body>
</html>
