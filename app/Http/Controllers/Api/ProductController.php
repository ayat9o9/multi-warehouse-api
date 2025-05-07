<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\Products\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $service
    ) {}

    public function index()
    {
        return response()->json($this->service->all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'sku'         => 'required|string|max:50|unique:products,sku',
            'status'      => 'required|in:active,inactive',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
        ]);

        $product = $this->service->create($validated);
        return response()->json($product, 201);
    }

    public function show(Product $product)
    {
        return response()->json($product);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'sku'         => 'required|string|max:50|unique:products,sku,' . $product->id,
            'status'      => 'required|in:active,inactive',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
        ]);

        $updated = $this->service->update($product, $validated);
        return response()->json($updated);
    }

    public function destroy(Product $product)
    {
        $this->service->delete($product);
        return response()->json(null, 204);
    }
}
