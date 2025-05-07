<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Inventory\InventoryService;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function __construct(
        protected InventoryService $service
    ) {}

    public function index()
    {
        return response()->json($this->service->all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id'        => 'required|exists:products,id',
            'warehouse_id'      => 'required|exists:warehouses,id',
            'quantity'          => 'required|integer',
            'minimum_quantity'  => 'nullable|integer'
        ]);

        $inventory = $this->service->create($data);
        return response()->json($inventory, 201);
    }

    public function show($id)
    {
        return response()->json($this->service->show($id));
    }

    public function update(Request $request, $id)
    {
        $inventory = $this->service->show($id);

        $data = $request->validate([
            'product_id'        => 'required|exists:products,id',
            'warehouse_id'      => 'required|exists:warehouses,id',
            'quantity'          => 'required|integer',
            'minimum_quantity'  => 'nullable|integer'
        ]);

        $updated = $this->service->update($inventory, $data);
        return response()->json($updated);
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return response()->json(['message' => 'Inventory deleted']);
    }

    public function transfer(Request $request)
    {
        $data = $request->validate([
            'product_id'        => 'required|exists:products,id',
            'from_warehouse_id' => 'required|exists:warehouses,id',
            'to_warehouse_id'   => 'required|exists:warehouses,id|different:from_warehouse_id',
            'quantity'          => 'required|integer|min:1',
        ]);

        $result = $this->service->transfer($data);

        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']], 422);
        }

        return response()->json(['message' => $result['message']]);
    }

    public function globalView()
    {
        return response()->json($this->service->globalView());
    }
}
