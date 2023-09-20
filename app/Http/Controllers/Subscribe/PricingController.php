<?php 

namespace App\Http\Controllers\Subscribe;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\User;
class PricingController extends Controller
{
    public function showPricing()
    {
        $user = Auth::user(); 
        $subscriptionPlans = Package::all(); 
        return view('subscription.manage', compact('user', 'subscriptionPlans'));
        
    }

    public function showUpgradeForm()
        {
            
            $user = User::find(auth()->id());
            return view('payment.upgrade', compact('user'));
        }

        public function processUpgrade(Request $request)
        {
            
            return redirect()->route('upgrade-success');
        }    

}
