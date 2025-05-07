<?php

namespace App\Repositories\Inventory;

use App\Models\Inventory;
use Illuminate\Support\Collection;

class InventoryRepository implements InventoryRepositoryInterface
{
    public function all(): Collection
    {
        return Inventory::all();
    }

    public function find(int $id): Inventory
    {
        return Inventory::findOrFail($id);
    }

    public function create(array $data): Inventory
    {
        return Inventory::create($data);
    }

    public function update(Inventory $inventory, array $data): Inventory
    {
        $inventory->update($data);
        return $inventory;
    }

    public function delete(int $id): void
    {
        Inventory::destroy($id);
    }

    public function transfer(array $data): array
    {
        $qty = $data['quantity'];

        $from = Inventory::firstOrCreate(
            ['product_id' => $data['product_id'], 'warehouse_id' => $data['from_warehouse_id']],
            ['quantity' => 0]
        );

        if ($from->quantity < $qty) {
            return ['error' => 'Not enough stock in source warehouse'];
        }

        $to = Inventory::firstOrCreate(
            ['product_id' => $data['product_id'], 'warehouse_id' => $data['to_warehouse_id']],
            ['quantity' => 0]
        );

        $from->quantity -= $qty;
        $from->save();

        $to->quantity += $qty;
        $to->save();

        return ['message' => 'Product transferred successfully'];
    }

    public function globalView(): Collection
    {
        return Inventory::with(['product', 'warehouse'])->get()->map(function ($inventory) {
            return [
                'product'      => $inventory->product->name,
                'warehouse'    => $inventory->warehouse->name,
                'quantity'     => $inventory->quantity,
                'min_required' => $inventory->minimum_quantity,
            ];
        });
    }
}
