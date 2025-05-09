<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\InventoryTransactionService;
use Illuminate\Http\Request;

class InventoryTransactionController extends Controller
{
    public function __construct(
        protected InventoryTransactionService $service
    ) {}
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id'       => 'required|exists:products,id',
            'warehouse_id'     => 'required|exists:warehouses,id',
            'supplier_id'      => 'nullable|exists:suppliers,id',
            'quantity'         => 'required|integer|min:1',
            'transaction_type' => 'required|in:IN,OUT',
            'date'             => 'required|date',
        ]);

        $tx = $this->service->store($validated);

        return response()->json($tx, 201);
    }

    public function report(Request $request)
    {
        $filters = $request->only(['from', 'to', 'warehouse_id', 'product_id', 'transaction_type']);
        $report = $this->service->getReport($filters);

        return response()->json($report);
    }
}
