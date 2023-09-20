<?php

namespace App\Http\Controllers\EmailTracking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailLog;

class EmailTrackingController extends Controller
{
    public function trackEmailOpen(Request $request)
    {
        $emailId = $request->input('email_id');
        
        EmailLog::create([
            'email_id' => $emailId,
            'opened_at' => now(),
        ]);
       
    }
}