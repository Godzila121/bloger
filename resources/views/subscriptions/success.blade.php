@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg card">
            <div class="p-6 text-gray-900" style="text-align: center;">
                <h3 class="text-lg font-medium" style="margin-top:0">✅ Дякуємо за підписку!</h3>
                <p class="mt-2">Ваш платіж успішно оброблено. Тепер у вас є доступ до преміум-статей.</p>
                <a href="{{ route('articles.index') }}" class="btn" style="margin-top: 1rem;">
                    Повернутися до довідника
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
