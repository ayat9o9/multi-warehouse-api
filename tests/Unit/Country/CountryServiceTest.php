<?php

namespace Tests\Unit\Country;

use Tests\TestCase;
use App\Models\Country;
use App\Services\Country\CountryService;
use App\Repositories\Country\CountryRepositoryInterface;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;

class CountryServiceTest extends TestCase
{
    use WithFaker;

    protected CountryService $service;
    protected $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = Mockery::mock(CountryRepositoryInterface::class);
        $this->service = new CountryService($this->repository);
    }

    /** @test */
    public function it_can_return_all_countries()
    {
        $countries = collect([
            new Country(['name' => 'Iraq', 'code' => 'IRQ']),
            new Country(['name' => 'Turkey', 'code' => 'TUR']),
        ]);

        $this->repository
            ->shouldReceive('all')
            ->once()
            ->andReturn($countries);

        $result = $this->service->all();

        $this->assertCount(2, $result);
        $this->assertEquals('Iraq', $result[0]->name);
    }

    /** @test */
    public function it_can_create_a_country()
    {
        $data = [
            'name' => 'Germany',
            'code' => 'DEU',
        ];

        $country = new Country($data);

        $this->repository
            ->shouldReceive('create')
            ->once()
            ->with($data)
            ->andReturn($country);

        $result = $this->service->create($data);

        $this->assertInstanceOf(Country::class, $result);
        $this->assertEquals('Germany', $result->name);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
