<?php

namespace App\Services\Products;

use App\Models\Product;
use App\Repositories\Products\ProductRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class ProductService
{
    private const CACHE_KEY_ALL_PRODUCTS = 'products:all';
    public function __construct(
        protected ProductRepositoryInterface $repository
    ) {}

    public function all(): Collection
    {
        return Cache::remember(self::CACHE_KEY_ALL_PRODUCTS, now()->addMinutes(60), function () {
            return $this->repository->all();
        });
    }

    public function create(array $data): Product
    {
        $product = $this->repository->create($data);
        Cache::forget(self::CACHE_KEY_ALL_PRODUCTS);
        return $product;
    }

    public function update(Product $product, array $data): Product
    {
        $updated = $this->repository->update($product, $data);
        Cache::forget(self::CACHE_KEY_ALL_PRODUCTS);
        return $updated;
    }

    public function delete(Product $product): void
    {
        $this->repository->delete($product);
        Cache::forget(self::CACHE_KEY_ALL_PRODUCTS);
    }
}
