<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use App\Services\Warehouse\WarehouseService;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function __construct(
        protected WarehouseService $service
    ) {}

    public function index()
    {
        return response()->json($this->service->all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'location'   => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
        ]);

        $warehouse = $this->service->create($validated);
        return response()->json($warehouse, 201);
    }

    public function show(Warehouse $warehouse)
    {
        $warehouse->load('country');
        return response()->json($warehouse);
    }

    public function update(Request $request, Warehouse $warehouse)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'location'   => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
        ]);

        $updated = $this->service->update($warehouse, $validated);
        return response()->json($updated);
    }

    public function destroy(Warehouse $warehouse)
    {
        $this->service->delete($warehouse);
        return response()->json(null, 204);
    }
}
