<?php

namespace App\Http\Controllers\Stripe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Stripe;




class StripePaymentController extends Controller
{
   
    public function stripePost(Request $request) 
    {
        
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
      
        Stripe\Charge::create ([
                "amount" => 10 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment " 
        ]);
                
        return back()
                ->with('success', 'Payment successful!');
    }
    
}
