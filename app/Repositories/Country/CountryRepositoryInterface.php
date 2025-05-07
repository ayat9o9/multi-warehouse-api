<?php

namespace App\Repositories\Country;

use Illuminate\Support\Collection;
use App\Models\Country;

interface CountryRepositoryInterface
{
    public function all(): Collection;
    public function find(int $id): Country;
    public function create(array $data): Country;
    public function update(Country $country, array $data): Country;
    public function delete(Country $country): void;
}
