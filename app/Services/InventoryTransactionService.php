<?php

namespace App\Services;

use App\Models\InventoryTransaction;
use App\Repositories\InventoryTransactionRepositoryInterface;
use Tymon\JWTAuth\Facades\JWTAuth;

class InventoryTransactionService
{
    public function __construct(
        protected InventoryTransactionRepositoryInterface $repository
    ) {}
    public function store(array $data): InventoryTransaction
    {
        $data['created_by'] = JWTAuth::user()->id; // Assuming you have authentication in place
        return $this->repository->store($data);
    }

    public function getReport(array $filters): array
    {
        $transactions = $this->repository->getFiltered($filters);

        return [
            'total'     => $transactions->count(),
            'total_in'  => $transactions->where('transaction_type', 'in')->sum('quantity'),
            'total_out' => $transactions->where('transaction_type', 'out')->sum('quantity'),
            'data'      => $transactions->map(function ($tx) {
                return [
                    'date'      => $tx->date,
                    'product'   => $tx->product->name ?? 'Unknown',
                    'warehouse' => $tx->warehouse->name ?? 'Unknown',
                    'transaction_type'      => $tx->type,
                    'quantity'  => $tx->quantity,
                ];
            })->toArray()
        ];
    }
}
