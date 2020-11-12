<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        return view('auth.payment', [
            'intent' => $user->createSetupIntent(),
            'amount' => env('STRIPE_AMOUNT'),
        ]);
    }

    public function charge(Request $request)
    {
        $user   = Auth::user();
        $amount = env('STRIPE_AMOUNT') * 100;

        if (!$user->hasStripeId()) {
          $user->createAsStripeCustomer([
            'email'  => $user->email
          ]);
        }

        $user->updateDefaultPaymentMethod($request->payment_method);

        $stripeCharge = $user->charge($amount, $request->payment_method);

        return redirect('/dashboard');
    }

    public function transactions()
    {
        $user = Auth::user();

        $stripe = new \Stripe\StripeClient(
          env('STRIPE_SECRET')
        );

        $transactions = $stripe->charges->all(['customer' => $user->stripe_id]);

        return view('profile/transactions', compact('transactions'))->render();
    }
}
