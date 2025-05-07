<?php

namespace Tests\Unit\Inventory;

use Tests\TestCase;
use App\Models\Inventory;
use App\Services\Inventory\InventoryService;
use App\Repositories\Inventory\InventoryRepositoryInterface;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;

class InventoryServiceTest extends TestCase
{
    use WithFaker;

    protected InventoryService $service;
    protected $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = Mockery::mock(InventoryRepositoryInterface::class);
        $this->service = new InventoryService($this->repository);
    }

    /** @test */
    public function it_can_return_all_inventory()
    {
        $inventories = collect([
            new Inventory(['product_id' => 1, 'warehouse_id' => 1, 'quantity' => 10]),
            new Inventory(['product_id' => 2, 'warehouse_id' => 1, 'quantity' => 20]),
        ]);

        $this->repository
            ->shouldReceive('all')
            ->once()
            ->andReturn($inventories);

        $result = $this->service->all();

        $this->assertCount(2, $result);
        $this->assertEquals(10, $result[0]->quantity);
    }

    /** @test */
    public function it_can_create_inventory()
    {
        $data = [
            'product_id' => 1,
            'warehouse_id' => 2,
            'quantity' => 30,
        ];

        $inventory = new Inventory($data);

        $this->repository
            ->shouldReceive('create')
            ->once()
            ->with($data)
            ->andReturn($inventory);

        $result = $this->service->create($data);

        $this->assertInstanceOf(Inventory::class, $result);
        $this->assertEquals(30, $result->quantity);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
