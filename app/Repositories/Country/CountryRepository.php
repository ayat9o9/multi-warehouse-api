<?php

namespace App\Repositories\Country;

use App\Models\Country;
use Illuminate\Support\Collection;

class CountryRepository implements CountryRepositoryInterface
{
    public function all(): Collection
    {
        return Country::all();
    }

    public function find(int $id): Country
    {
        return Country::findOrFail($id);
    }

    public function create(array $data): Country
    {
        return Country::create($data);
    }

    public function update(Country $country, array $data): Country
    {
        $country->update($data);
        return $country;
    }

    public function delete(Country $country): void
    {
        $country->delete();
    }
}
