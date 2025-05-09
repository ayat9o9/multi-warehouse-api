<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupplierRequest;
use App\Models\Supplier;
use App\Services\Suppliers\SupplierService;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function __construct(protected SupplierService $service) {}


    public function index()
    {
        return response()->json($this->service->all(), 200);
    }

    public function store(StoreSupplierRequest $request)
    {
        $supplier = $this->service->create($request->validated());
        return response()->json($supplier, 201);
    }

    public function show(Supplier $supplier)
    {
        return response()->json($supplier);
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'contact_info' => 'required|string|max:255',
            'address'      => 'required|string|max:255',
        ]);

        $updated = $this->service->update($supplier, $validated);
        return response()->json($updated);
    }

    public function destroy(Supplier $supplier)
    {
        $this->service->delete($supplier);
        return response()->json(null, 204);
    }
}
