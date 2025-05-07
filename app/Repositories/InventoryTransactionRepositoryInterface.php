<?php

namespace App\Repositories;

use App\Models\InventoryTransaction;
use Illuminate\Support\Collection;

interface InventoryTransactionRepositoryInterface
{
    public function getFiltered(array $filters): Collection;
    public function store(array $data): InventoryTransaction;
}
