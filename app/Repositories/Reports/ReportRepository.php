<?php

namespace App\Repositories\Reports;

use App\Models\Inventory;
use Illuminate\Support\Collection;

class ReportRepository implements ReportRepositoryInterface
{
    public function lowStock(): Collection
    {
        return Inventory::with(['product', 'warehouse'])
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
    }
}
