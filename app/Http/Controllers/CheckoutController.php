<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Notifications\PaymentSuccessNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class CheckoutController extends Controller
{
    public function index() {
        $product = [
            'name' => 'G-Shock Watch',
            'price' => 7999,
        ];

        $user = [
            'name' => 'John Denver',
            'email' => 'john@example.com'
        ];

        return view('index')->with(['product' => $product, 'user' => $user]);
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
        ]);

        \Stripe\Stripe::setApiKey(env('STRIPE_SK'));

        $amountINR = $request->amount; // Amount in INR
        $amountPaise = $amountINR * 100; // Convert to paise

        // Minimum allowed in INR (₹50)
        $minimumINR = 50;
        if ($amountINR < $minimumINR) {
            return back()->withErrors("Stripe requires a minimum charge of ₹{$minimumINR}.");
        }

        $session = \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'inr',
                        'product_data' => [
                            'name' => 'G-Shock Watch',
                        ],
                        'unit_amount' => $amountPaise,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('index'),
            // Adding user data to fetch later in success page
            'metadata' => [
                'customer_name'  => $request->customer_name,
                'customer_email' => $request->customer_email,
                'amount'         => $amountINR,
                '_token'         => $request->_token,
            ],
        ]);

        return redirect()->away($session->url);
    }

    public function success(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SK'));

        $sessionId = $request->session_id;
        $session = \Stripe\Checkout\Session::retrieve($sessionId);

        // Log::info('$session:'. json_encode($session));

        $paymentIntent = \Stripe\PaymentIntent::retrieve($session->payment_intent);

        $metaData = $session->metadata;

        $payment = Payment::create([
            'customer_name' => $metaData->customer_name,
            'customer_email' => $metaData->customer_email,
            'amount' => $metaData->amount,
            'payment_gateway' => 'stripe',
            'transaction_id' => $paymentIntent->id, // pi_XXXXXXXX
            'status' => $paymentIntent->status,    // succeeded, processing, etc.
        ]);

        // Email customer after payment
        Notification::route('mail', $metaData->customer_email)
            ->notify(new PaymentSuccessNotification([
                'customer_name'  => $metaData->customer_name,
                'amount'         => $metaData->amount,
                'transaction_id' => $paymentIntent->id,
                'status'         => $paymentIntent->status,
            ]));

        return view('success')->with([
            'transactionId' => $paymentIntent->id,
            'amount' => $metaData->amount,
            'customer' => [
                'name' => $metaData->customer_name,
                'email' => $metaData->customer_email,
            ]
        ]);
    }


}
