<?php

namespace App\Services\Products;

use App\Models\Product;
use App\Repositories\Products\ProductRepositoryInterface;
use Illuminate\Support\Collection;

class ProductService
{
    public function __construct(
        protected ProductRepositoryInterface $repository
    ) {}

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function create(array $data): Product
    {
        return $this->repository->create($data);
    }

    public function update(Product $product, array $data): Product
    {
        return $this->repository->update($product, $data);
    }

    public function delete(Product $product): void
    {
        $this->repository->delete($product);
    }
}
