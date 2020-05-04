<?php namespace Tests\Repositories;

use Modules\Venta\Entities\Venta;
use Modules\Venta\Repositories\VentaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class VentaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var VentaRepository
     */
    protected $ventaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->ventaRepo = \App::make(VentaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_venta()
    {
        $venta = factory(Venta::class)->make()->toArray();

        $createdVenta = $this->ventaRepo->create($venta);

        $createdVenta = $createdVenta->toArray();
        $this->assertArrayHasKey('id', $createdVenta);
        $this->assertNotNull($createdVenta['id'], 'Created Venta must have id specified');
        $this->assertNotNull(Venta::find($createdVenta['id']), 'Venta with given id must be in DB');
        $this->assertModelData($venta, $createdVenta);
    }

    /**
     * @test read
     */
    public function test_read_venta()
    {
        $venta = factory(Venta::class)->create();

        $dbVenta = $this->ventaRepo->find($venta->id);

        $dbVenta = $dbVenta->toArray();
        $this->assertModelData($venta->toArray(), $dbVenta);
    }

    /**
     * @test update
     */
    public function test_update_venta()
    {
        $venta = factory(Venta::class)->create();
        $fakeVenta = factory(Venta::class)->make()->toArray();

        $updatedVenta = $this->ventaRepo->update($fakeVenta, $venta->id);

        $this->assertModelData($fakeVenta, $updatedVenta->toArray());
        $dbVenta = $this->ventaRepo->find($venta->id);
        $this->assertModelData($fakeVenta, $dbVenta->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_venta()
    {
        $venta = factory(Venta::class)->create();

        $resp = $this->ventaRepo->delete($venta->id);

        $this->assertTrue($resp);
        $this->assertNull(Venta::find($venta->id), 'Venta should not exist in DB');
    }
}
