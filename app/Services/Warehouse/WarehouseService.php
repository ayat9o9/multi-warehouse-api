<?php

namespace App\Services\Warehouse;

use App\Models\Warehouse;
use App\Repositories\Warehouse\WarehouseRepositoryInterface;
use Illuminate\Support\Collection;

class WarehouseService
{
    public function __construct(
        protected WarehouseRepositoryInterface $repository
    ) {}

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function create(array $data): Warehouse
    {
        return $this->repository->create($data);
    }

    public function update(Warehouse $warehouse, array $data): Warehouse
    {
        return $this->repository->update($warehouse, $data);
    }

    public function delete(Warehouse $warehouse): void
    {
        $this->repository->delete($warehouse);
    }
}
