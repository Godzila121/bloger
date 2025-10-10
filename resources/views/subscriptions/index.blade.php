<!DOCTYPE html>
<html>
<head>
    <title>Subscriptions</title>
</head>
<body>
    <h1>Subscribe for Premium Content</h1>

    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('subscriptions.store') }}" method="POST">
        @csrf
        <label>
            <input type="radio" name="plan" value="monthly" checked> Monthly Plan
        </label>
        <label>
            <input type="radio" name="plan" value="yearly"> Yearly Plan
        </label>
        <button type="submit">Subscribe</button>
    </form>
</body>
</html>
