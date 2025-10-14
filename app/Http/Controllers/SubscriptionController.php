<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LiqPay; // Додаємо LiqPay

class SubscriptionController extends Controller
{
    public function index()
    {
        // Тут можна додати логіку для вибору різних планів підписки
        return view('subscriptions.index');
    }

    public function createPayment(Request $request)
    {
        // 1. Отримуємо ключі з конфігурації
        $publicKey = config('services.liqpay.public_key');
        $privateKey = config('services.liqpay.private_key');

        // 2. Ініціалізуємо LiqPay
        $liqpay = new LiqPay($publicKey, $privateKey);

        // 3. Створюємо параметри для платежу
        $params = [
            'action'         => 'pay',
            'amount'         => '1', // Тестова сума
            'currency'       => 'UAH',
            'description'    => 'Тестова підписка на 1 місяць',
            'order_id'       => 'order_' . time(), // Унікальний ID замовлення
            'version'        => '3',
            'sandbox'        => 1, // Вмикає тестовий режим!
            'result_url'     => route('subscriptions.index'), // Куди повернути користувача після оплати
            //'server_url'   => route('liqpay.callback'), // Адреса для отримання статусу платежу (зробимо пізніше)
        ];

        // 4. Генеруємо HTML-форму з кнопкою
        $html = $liqpay->cnb_form($params);

        // Повертаємо на сторінку підписок, передаючи їй згенеровану кнопку
        return view('subscriptions.index', ['paymentForm' => $html]);
    }
}
