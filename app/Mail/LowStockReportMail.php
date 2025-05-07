<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LowStockReportMail extends Mailable
{
    use Queueable, SerializesModels;
    public array $report;

    public function __construct(array $report)
    {
        $this->report = $report;
    }

    public function build()
    {
        return $this->subject('Daily Low Stock Report')
            ->view('emails.low_stock'); // ✅ Must match your blade file name
    }
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Low Stock Report',
        );
    }
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.low_stock',
            with: [
                'report' => $this->report,
            ],
        );
    }
    public function attachments(): array
    {
        return [];
    }
}
