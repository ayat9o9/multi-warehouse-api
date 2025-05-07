<?php

namespace Tests\Unit\Warehouse;

use Tests\TestCase;
use App\Models\Warehouse;
use App\Services\Warehouse\WarehouseService;
use App\Repositories\Warehouse\WarehouseRepositoryInterface;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;

class WarehouseServiceTest extends TestCase
{
    use WithFaker;

    protected WarehouseService $service;
    protected $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = Mockery::mock(WarehouseRepositoryInterface::class);
        $this->service = new WarehouseService($this->repository);
    }

    /** @test */
    public function it_can_list_all_warehouses()
    {
        $warehouses = collect([
            new Warehouse(['name' => 'Erbil Warehouse', 'location' => 'Erbil', 'country_id' => 1]),
            new Warehouse(['name' => 'Sulaymaniyah Warehouse', 'location' => 'Suli', 'country_id' => 1]),
        ]);

        $this->repository->shouldReceive('all')->once()->andReturn($warehouses);

        $result = $this->service->all();

        $this->assertCount(2, $result);
        $this->assertEquals('Erbil Warehouse', $result[0]->name);
    }

    /** @test */
    public function it_can_create_warehouse()
    {
        $data = [
            'name' => 'Baghdad Warehouse',
            'location' => 'Baghdad',
            'country_id' => 1,
        ];

        $warehouse = new Warehouse($data);

        $this->repository->shouldReceive('create')->once()->with($data)->andReturn($warehouse);

        $result = $this->service->create($data);

        $this->assertInstanceOf(Warehouse::class, $result);
        $this->assertEquals('Baghdad Warehouse', $result->name);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
