@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg card">
            <div class="p-6 text-gray-900">
                <h3 class="text-lg font-medium" style="margin-top:0">Оберіть план</h3>
                <p class="mt-2">Підписка "Преміум" - 1 грн (тестовий платіж)</p>

                {{-- Якщо кнопка оплати згенерована, показуємо її --}}
                @if(isset($paymentForm))
                    {!! $paymentForm !!}
                @else
                {{-- Інакше, показуємо нашу форму, яка відправить запит на створення кнопки --}}
                    <form method="POST" action="{{ route('subscriptions.createPayment') }}">
                        @csrf
                        <button type="submit" class="btn" style="margin-top: 1rem;">
                            Купити підписку
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
