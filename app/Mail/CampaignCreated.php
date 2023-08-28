<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;



class CampaignCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $emailData;

    public function __construct($subject,$emailData)
    {
        $this->emailData = $emailData;
        $this->subject = $subject;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(

            subject: $this->subject,
            
        );
    }

    
    public function content(): Content
    {
        return new Content(
            view: 'template.views.mail-template',
            with: [
               
                'emailData' => $this->emailData,
                'subject'   => $this->subject
                
            ],
        );
    }

    
    public function attachments(): array
    {
        return [];
    }
}
