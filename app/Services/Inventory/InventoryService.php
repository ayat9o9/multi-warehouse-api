<?php

namespace App\Services\Inventory;

use App\Models\Inventory;
use App\Repositories\Inventory\InventoryRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
class InventoryService
{
    private const CACHE_KEY_ALL_INVENTORIES = 'inventory:global';
    public function __construct(
        protected InventoryRepositoryInterface $repository
    ) {}

    public function all(): Collection
    {
        return Cache::remember(self::CACHE_KEY_ALL_INVENTORIES, now()->addMinutes(60), fn() => $this->repository->all());
    }

    public function create(array $data): Inventory
    {
        Cache::forget(self::CACHE_KEY_ALL_INVENTORIES);
        return $this->repository->create($data);
    }

    public function show(int $id): Inventory
    {
        return $this->repository->find($id);
    }

    public function update(Inventory $inventory, array $data): Inventory
    {
        Cache::forget(self::CACHE_KEY_ALL_INVENTORIES);
        return $this->repository->update($inventory, $data);
    }

    public function delete(int $id): void
    {
        Cache::forget(self::CACHE_KEY_ALL_INVENTORIES);
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
