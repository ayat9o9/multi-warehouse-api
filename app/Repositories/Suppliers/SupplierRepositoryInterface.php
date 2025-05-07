<?php

namespace App\Repositories\Suppliers;

use App\Models\Supplier;
use Illuminate\Support\Collection;

interface SupplierRepositoryInterface
{
    public function all(): Collection;
    public function create(array $data): Supplier;
    public function update(Supplier $supplier, array $data): Supplier;
    public function delete(Supplier $supplier): void;
}
