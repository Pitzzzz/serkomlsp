<?php

namespace Tests\Feature;

use App\Mail\SubmissionReplyMail;
use App\Models\Consultation;
use App\Models\ContactMessage;
use App\Services\AdminReplyService;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use RuntimeException;
use Tests\TestCase;

class AdminReplyServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config([
            'database.default' => 'sqlite',
            'database.connections.sqlite.database' => ':memory:',
        ]);
        DB::purge('sqlite');

        Schema::create('contact_messages', function (Blueprint $table): void {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('topik');
            $table->text('pesan');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });

        Schema::create('admin_replies', function (Blueprint $table): void {
            $table->id();
            $table->morphs('replyable');
            $table->string('recipient');
            $table->string('subject');
            $table->text('body');
            $table->timestamp('sent_at');
            $table->timestamps();
        });

        Schema::create('consultations', function (Blueprint $table): void {
            $table->id();
            $table->string('nama');
            $table->string('perusahaan')->nullable();
            $table->string('email');
            $table->string('telepon');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('layanan');
            $table->string('anggaran');
            $table->text('kebutuhan');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    public function test_it_emails_and_records_a_contact_reply(): void
    {
        Mail::fake();
        config(['mail.default' => 'array']);

        $contact = ContactMessage::query()->create([
            'nama' => 'Ayu',
            'email' => 'ayu@example.test',
            'topik' => 'Pertanyaan layanan',
            'pesan' => 'Mohon informasi.',
        ]);

        app(AdminReplyService::class)->send($contact, 'Terima kasih sudah menghubungi kami.');

        Mail::assertSent(SubmissionReplyMail::class, function (SubmissionReplyMail $mail): bool {
            return $mail->hasTo('ayu@example.test')
                && $mail->envelope()->subject === 'Balasan: Pertanyaan layanan'
                && $mail->body === 'Terima kasih sudah menghubungi kami.';
        });

        $this->assertDatabaseHas('admin_replies', [
            'replyable_type' => ContactMessage::class,
            'replyable_id' => $contact->id,
            'recipient' => 'ayu@example.test',
            'subject' => 'Balasan: Pertanyaan layanan',
            'body' => 'Terima kasih sudah menghubungi kami.',
        ]);
    }

    public function test_it_refuses_to_report_success_when_mailer_only_logs(): void
    {
        config(['mail.default' => 'log']);

        $contact = ContactMessage::query()->create([
            'nama' => 'Ayu',
            'email' => 'ayu@example.test',
            'topik' => 'Pertanyaan layanan',
            'pesan' => 'Mohon informasi.',
        ]);

        try {
            app(AdminReplyService::class)->send($contact, 'Balasan.');
            $this->fail('Expected email configuration error was not thrown.');
        } catch (RuntimeException $exception) {
            $this->assertStringContainsString('Atur MAIL_MAILER', $exception->getMessage());
        }

        $this->assertDatabaseCount('admin_replies', 0);
    }

    public function test_it_emails_and_records_a_consultation_reply(): void
    {
        Mail::fake();
        config(['mail.default' => 'array']);

        $consultation = Consultation::query()->create([
            'nama' => 'Budi',
            'email' => 'budi@example.test',
            'telepon' => '08123456789',
            'layanan' => 'Website Perusahaan',
            'anggaran' => 'Rp 10–25 juta',
            'kebutuhan' => 'Membutuhkan website perusahaan.',
        ]);

        app(AdminReplyService::class)->send($consultation, 'Kami akan segera menghubungi Anda.');

        Mail::assertSent(SubmissionReplyMail::class, function (SubmissionReplyMail $mail): bool {
            return $mail->hasTo('budi@example.test')
                && $mail->envelope()->subject === 'Balasan konsultasi: Website Perusahaan'
                && $mail->body === 'Kami akan segera menghubungi Anda.';
        });

        $this->assertDatabaseHas('admin_replies', [
            'replyable_type' => Consultation::class,
            'replyable_id' => $consultation->id,
            'recipient' => 'budi@example.test',
            'subject' => 'Balasan konsultasi: Website Perusahaan',
            'body' => 'Kami akan segera menghubungi Anda.',
        ]);
    }
}
