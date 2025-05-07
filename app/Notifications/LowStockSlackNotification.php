<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Queue\SerializesModels;

class LowStockSlackNotification extends Notification implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public array $report) {}

    public function via($notifiable): array
    {
        return ['slack'];
    }

    public function toSlack($notifiable): SlackMessage
    {
        return (new SlackMessage)
            ->error()
            ->content('⚠️ Daily Low Stock Alert')
            ->attachment(function ($attachment) {
                foreach ($this->report as $item) {
                    $attachment->fields([
                        'Product'   => $item['product'],
                        'Warehouse' => $item['warehouse'],
                        'Qty'       => $item['quantity'],
                        'Required'  => $item['required'],
                    ]);
                }
            });
    }
}
