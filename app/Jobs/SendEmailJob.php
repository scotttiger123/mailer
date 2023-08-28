<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Mail\CampaignCreated;
use Illuminate\Support\Facades\Mail;


class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    public $emailAddress;
    public $emailData;

    public function __construct($emailAddress, $emailData)
    {
        $this->emailAddress = $emailAddress;
        $this->emailData    = $emailData;
    }
      
    
  
    public function handle()
    {
        
        
        Mail::to($this->emailAddress)->send(new CampaignCreated($this->emailData['subject'], $this->emailData));
    }
}

