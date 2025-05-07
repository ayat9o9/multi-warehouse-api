<?php

namespace App\Repositories\Warehouse;

use App\Models\Warehouse;
use Illuminate\Support\Collection;

interface WarehouseRepositoryInterface
{
    public function all(): Collection;
    public function create(array $data): Warehouse;
    public function update(Warehouse $warehouse, array $data): Warehouse;
    public function delete(Warehouse $warehouse): void;
}
