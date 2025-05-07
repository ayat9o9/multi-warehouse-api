<?php

namespace App\Repositories;

use App\Models\InventoryTransaction;
use Illuminate\Support\Collection;

class InventoryTransactionRepository implements InventoryTransactionRepositoryInterface
{
    public function getFiltered(array $filters): Collection
    {
        $query = InventoryTransaction::with(['product', 'warehouse']);

        if (isset($filters['from'], $filters['to'])) {
            $query->whereBetween('date', [
                $filters['from'] . ' 00:00:00',
                $filters['to'] . ' 23:59:59'
            ]);
        }

        if (isset($filters['warehouse_id'])) {
            $query->where('warehouse_id', $filters['warehouse_id']);
        }

        if (isset($filters['product_id'])) {
            $query->where('product_id', $filters['product_id']);
        }

        if (isset($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        return $query->get();
    }

    public function store(array $data): InventoryTransaction
    {
        return InventoryTransaction::create($data);
    }
}
