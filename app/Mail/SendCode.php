<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class SendCode extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $content;
    public $customerName;
    public function __construct($content, $customerName)
    {
        $this->content = $content;
        $this->customerName = $customerName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        /**
        * This is the Mail Header.
        */
        return new Envelope(
            from: new Address('yourWebsite@email.com', 'YOUR WEBSITE'),
            subject: 'This is your Code for Reset Password',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'codeMail',
            with: [
                    'content' => $this->content,
                    'customerName' => $this->customerName, 
                  ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
