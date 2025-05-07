<?php

namespace App\Repositories\Warehouse;

use App\Models\Warehouse;
use Illuminate\Support\Collection;

class WarehouseRepository implements WarehouseRepositoryInterface
{
    public function all(): Collection
    {
        return Warehouse::with('country')->get();
    }

    public function create(array $data): Warehouse
    {
        return Warehouse::create($data);
    }

    public function update(Warehouse $warehouse, array $data): Warehouse
    {
        $warehouse->update($data);
        return $warehouse;
    }

    public function delete(Warehouse $warehouse): void
    {
        $warehouse->delete();
    }
}
