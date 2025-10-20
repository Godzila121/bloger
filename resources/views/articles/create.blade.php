@extends('layouts.app')

@section('content')
<section class="grid">
    <main>
        <div class="card">
            <h2 style="margin:0 0 1rem;">Створити нову статтю</h2>

            {{-- Форма для створення статті --}}
            <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Поле для заголовка --}}
                <div style="margin-bottom: 1rem;">
                    <label for="title" style="display: block; font-weight: bold; margin-bottom: 0.5rem;">Заголовок</label>
                    <input type="text" id="title" name="title" required style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                </div>

                {{-- Поле для вмісту --}}
                <div style="margin-bottom: 1rem;">
                    <label for="content" style="display: block; font-weight: bold; margin-bottom: 0.5rem;">Вміст статті</label>
                    <textarea id="content" name="content" rows="10" required style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;"></textarea>
                </div>

{{-- Поле для вибору теми --}}
<div style="margin-bottom: 1rem;">
    <label for="topic_id" style="display: block; font-weight: bold; margin-bottom: 0.5rem;">Тема</label>
    <select name="topic_id" id="topic_id" required style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
        @foreach($topics as $topic)
            <option value="{{ $topic->id }}">{{ $topic->name }}</option>
        @endforeach
    </select>
</div>

                {{-- Поле для завантаження зображення --}}
                <div style="margin-bottom: 1rem;">
                    <label for="image" style="display: block; font-weight: bold; margin-bottom: 0.5rem;">Зображення (необов'язково)</label>
                    <input type="file" id="image" name="image" style="width: 100%;">
                </div>

                {{-- Чекбокс для преміум-статті --}}
                <div style="margin-bottom: 1.5rem;">
                    <label for="is_premium" style="display: flex; align-items: center;">
                        <input type="checkbox" id="is_premium" name="is_premium" value="1" style="margin-right: 0.5rem;">
                        <span>Це преміум-стаття</span>
                    </label>
                </div>

                {{-- Кнопка для відправки форми --}}
                <button type="submit" class="btn" style="border: none; cursor: pointer;">Опублікувати статтю</button>
            </form>
        </div>
    </main>
</section>
@endsection
