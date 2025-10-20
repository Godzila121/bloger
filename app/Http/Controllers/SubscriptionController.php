<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LiqPay;

class SubscriptionController extends Controller
{
    public function index()
    {
        return view('subscriptions.index');
    }

    public function createPayment(Request $request)
    {

        $publicKey = config('services.liqpay.public_key');
        $privateKey = config('services.liqpay.private_key');

        $liqpay = new LiqPay($publicKey, $privateKey);

        $params = [
            'action'         => 'pay',
            'amount'         => '1', // Тестова сума
            'currency'       => 'UAH',
            'description'    => 'Тестова підписка на 1 місяць',
            'order_id'       => 'order_' . time(), // Унікальний ID замовлення
            'version'        => '3',
            'sandbox'        => 1, // Вмикає тестовий режим!
            'result_url'     => route('subscriptions.success'), // Куди повернути користувача після оплати
        ];

        $html = $liqpay->cnb_form($params);

        return view('subscriptions.index', ['paymentForm' => $html]);
    }
public function handleLiqPayCallback(Request $request)
    {
        $data = $request->input('data');
        $signature = $request->input('signature');

        $private_key = env('LIQPAY_PRIVATE_KEY');
        $expected_signature = base64_encode(sha1($private_key . $data . $private_key, 1));

        // Перевіряємо, чи підпис валідний
        if ($signature !== $expected_signature) {
            // Якщо підпис не валідний, ігноруємо запит
            return response('Invalid signature', 400);
        }

        $decoded_data = json_decode(base64_decode($data), true);

        // Перевіряємо статус платежу
        if (in_array($decoded_data['status'], ['success', 'sandbox'])) {
            // Знаходимо підписку за order_id
            $subscription = Subscription::where('order_id', $decoded_data['order_id'])->first();

            if ($subscription) {
                // Оновлюємо статус підписки
                $subscription->status = 'active'; // Або будь-який інший статус, який ви використовуєте
                $subscription->save();
            }
        }

        // Повертаємо відповідь для LiqPay
        return response('OK', 200);
    }
public function success()
    {
        // В майбутньому тут можна буде оновити статус підписки користувача
        return view('subscriptions.success');
    }
}
