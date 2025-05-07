<?php

namespace App\Console\Commands;

use App\Mail\LowStockReportMail;
use App\Models\Inventory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendLowStockReport extends Command
{
    protected $signature = 'inventory:check-low-stock';
    protected $description = 'Send daily low stock email report';

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

        // Send mail to recipient
        Mail::to('aeatxalid4@gmail.com')->send(new LowStockReportMail($lowStock->toArray()));

        $this->info('Low stock report sent successfully!');
    }
}
