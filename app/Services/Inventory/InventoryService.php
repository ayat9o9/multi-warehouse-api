<?php

namespace App\Services\Inventory;

use App\Models\Inventory;
use App\Repositories\Inventory\InventoryRepositoryInterface;
use Illuminate\Support\Collection;

class InventoryService
{
    public function __construct(
        protected InventoryRepositoryInterface $repository
    ) {}

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function create(array $data): Inventory
    {
        return $this->repository->create($data);
    }

    public function show(int $id): Inventory
    {
        return $this->repository->find($id);
    }

    public function update(Inventory $inventory, array $data): Inventory
    {
        return $this->repository->update($inventory, $data);
    }

    public function delete(int $id): void
    {
        $this->repository->delete($id);
    }

    public function transfer(array $data): array
    {
        return $this->repository->transfer($data);
    }

    public function globalView(): Collection
    {
        return $this->repository->globalView();
    }
}
