<?php

namespace App\Repositories\Inventory;

use Illuminate\Support\Collection;
use App\Models\Inventory;

interface InventoryRepositoryInterface
{
    public function all(): Collection;
    public function find(int $id): Inventory;
    public function create(array $data): Inventory;
    public function update(Inventory $inventory, array $data): Inventory;
    public function delete(int $id): void;
    public function transfer(array $data): array;
    public function globalView(): Collection;
}
