<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Підписки') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium">Оберіть план</h3>
                    <p class="mt-2">Підписка "Преміум" - 1 грн (тестовий платіж)</p>

                    {{-- Якщо кнопка оплати згенерована, показуємо її --}}
                    @if(isset($paymentForm))
                        {!! $paymentForm !!}
                    @else
                    {{-- Інакше, показуємо нашу форму, яка відправить запит на створення кнопки --}}
                        <form method="POST" action="{{ route('subscriptions.createPayment') }}">
                            @csrf
                            <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">
                                Купити підписку
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
