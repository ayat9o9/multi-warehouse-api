<?php

namespace App\Services\Country;

use App\Models\Country;
use App\Repositories\Country\CountryRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CountryService
{
    private const CACHE_KEY_ALL_COUNTRIES = 'countries:all';
    public function __construct(
        protected CountryRepositoryInterface $repository
    ) {}

    public function all(): Collection
    {
        return Cache::remember(self::CACHE_KEY_ALL_COUNTRIES, now()->addMinutes(60), fn() => $this->repository->all());
    }

    public function create(array $data): Country
    {
        Cache::forget(self::CACHE_KEY_ALL_COUNTRIES);
        return $this->repository->create($data);
    }

    public function show(Country $country): Country
    {
        return $country;
    }

    public function update(Country $country, array $data): Country
    {
        Cache::forget(self::CACHE_KEY_ALL_COUNTRIES);
        return $this->repository->update($country, $data);
    }

    public function delete(Country $country): void
    {
        Cache::forget(self::CACHE_KEY_ALL_COUNTRIES);
        $this->repository->delete($country);
    }
}
