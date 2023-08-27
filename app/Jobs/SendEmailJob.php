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
    protected $emailAddress;
    protected $campaignData;

    public function __construct($emailAddress, $campaignData)
    {
        $this->emailAddress = $emailAddress;
        $this->campaignData = $campaignData;
    }

    public function handle()
    {
        
        //Mail::to("phpfreak4u@gmail.com")->send(new CampaignCreated($this->campaignData));
        Mail::to("phpfreak4u@gmail.com") ->send(new CampaignCreated($this->campaignData));
    }
}
