<?php

namespace App\Console\Commands;

use App\Models\Inventory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use App\Notifications\LowStockSlackNotification;

class SendSlackLowStockNotification extends Command
{
    protected $signature = 'notify:slack-low-stock';
    protected $description = 'Send low stock report to Slack';

    public function handle(): void
    {
        $lowStock = Inventory::with(['product', 'warehouse'])
            ->whereColumn('quantity', '<', 'minimum_quantity')
            ->get()
            ->map(function ($item) {
                return [
                    'product'   => $item->product->name,
                    'warehouse' => $item->warehouse->name,
                    'quantity'  => $item->quantity,
                    'required'  => $item->minimum_quantity,
                ];
            });

        Notification::route('slack', env('SLACK_WEBHOOK_URL'))
            ->notify(new LowStockSlackNotification($lowStock->toArray()));

        $this->info('Low stock Slack notification sent.');
    }
}
