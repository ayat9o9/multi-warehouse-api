<?php

namespace App\Services\Suppliers;


use App\Models\Supplier;
use App\Repositories\Suppliers\SupplierRepositoryInterface;
use Illuminate\Support\Collection;

class SupplierService
{
    public function __construct(
        protected SupplierRepositoryInterface $repository
    ) {}

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function create(array $data): Supplier
    {
        return $this->repository->create($data);
    }

    public function update(Supplier $supplier, array $data): Supplier
    {
        return $this->repository->update($supplier, $data);
    }

    public function delete(Supplier $supplier): void
    {
        $this->repository->delete($supplier);
    }
}
