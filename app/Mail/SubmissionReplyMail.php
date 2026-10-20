<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SubmissionReplyMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(
        public string $subjectLine,
        public string $body,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subjectLine,
            replyTo: [
                new Address(config('mail.from.address'), config('mail.from.name')),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.submission-reply',
        );
    }
}
