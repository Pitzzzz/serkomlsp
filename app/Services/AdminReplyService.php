<?php

namespace App\Services;

use App\Exceptions\ReplyEmailException;
use App\Mail\SubmissionReplyMail;
use App\Models\Consultation;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class AdminReplyService
{
    public function send(ContactMessage|Consultation $submission, string $body): void
    {
        if (config('mail.default') === 'log') {
            throw new ReplyEmailException('Email belum dikonfigurasi. Atur MAIL_MAILER dan kredensial SMTP sebelum mengirim balasan.');
        }

        $subject = $submission instanceof Consultation
            ? 'Balasan konsultasi: '.$submission->layanan
            : 'Balasan: '.$submission->topik;

        try {
            Mail::to($submission->email, $submission->nama)
                ->send(new SubmissionReplyMail($subject, $body));
        } catch (TransportExceptionInterface $exception) {
            throw new ReplyEmailException('Email gagal dikirim: '.$exception->getMessage(), previous: $exception);
        }

        $submission->replies()->create([
            'recipient' => $submission->email,
            'subject' => $subject,
            'body' => $body,
            'sent_at' => now(),
        ]);
    }
}
