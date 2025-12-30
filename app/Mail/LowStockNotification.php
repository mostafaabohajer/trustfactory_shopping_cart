<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class LowStockNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Collection $products,
        public int $threshold
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Low Stock Notification',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.low-stock-notification',
        );
    }
}
