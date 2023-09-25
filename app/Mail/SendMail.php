<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Cart;
use Illuminate\Mail\Mailables\Address;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $content;
    public $customer;
    public $total;
    public function __construct($content, $customer, $total) {
        $this->content = $content;
        $this->customer = $customer;
        $this->total = $total;
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('votehub.org.2021@gmail.com', 'Brigada Healthline Corp.'),
            subject: 'Thank you for ordering!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'email',
            with: ['content' => $this->content,
                    'customer' => $this->customer,
                    'total' => $this->total]

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
