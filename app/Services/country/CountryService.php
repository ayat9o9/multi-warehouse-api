<?php

namespace App\Services\Country;

use App\Models\Country;
use App\Repositories\Country\CountryRepositoryInterface;
use Illuminate\Support\Collection;

class CountryService
{
    public function __construct(
        protected CountryRepositoryInterface $repository
    ) {}

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function create(array $data): Country
    {
        return $this->repository->create($data);
    }

    public function show(Country $country): Country
    {
        return $country;
    }

    public function update(Country $country, array $data): Country
    {
        return $this->repository->update($country, $data);
    }

    public function delete(Country $country): void
    {
        $this->repository->delete($country);
    }
}
