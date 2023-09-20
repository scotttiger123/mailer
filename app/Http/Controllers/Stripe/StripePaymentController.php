<?php

namespace App\Http\Controllers\Stripe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

use Stripe;




class StripePaymentController extends Controller
{
   
   
    public function stripePost(Request $request)
{
    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    try {
        $charge = Stripe\Charge::create([
            "amount" => 10 * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment"
        ]);

        
        Payment::create([
            'amount' => $charge->amount / 100, // Convert cents to dollars
            'description' => $charge->description,
            'created_by' => auth()->user()->id
            
        ]);

        return back()
            ->with('success', 'Payment successful!');
    } catch (Exception $e) {
        return back()
            ->with('error', 'Payment failed: ' . $e->getMessage());
    }
}

}
