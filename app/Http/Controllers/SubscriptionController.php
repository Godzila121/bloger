<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        return view('subscriptions.index');
    }

    public function store(Request $request)
    {
        $request->validate(['plan' => 'required|string|in:monthly,yearly']);

        // Тут має бути логіка оплати (Stripe, LiqPay, etc.)

        auth()->user()->subscriptions()->create([
            'type' => $request->plan,
            'expires_at' => $request->plan === 'monthly' ? now()->addMonth() : now()->addYear(),
        ]);

        return redirect()->route('articles.index')->with('success', 'You have successfully subscribed!');
    }
}
