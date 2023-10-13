<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;


class QueueWorkController extends Controller
{
    public function startQueueWork()
    {
       
        Artisan::call('queue:work --timeout=0');

        echo "query started";
        
    }
}
