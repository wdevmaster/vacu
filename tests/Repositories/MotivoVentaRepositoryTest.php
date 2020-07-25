<?php namespace Tests\Repositories;

use Modules\Venta\Entities\MotivoVenta;
use Modules\Venta\Repositories\MotivoVentaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MotivoVentaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MotivoVentaRepository
     */
    protected $motivoVentaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->motivoVentaRepo = \App::make(MotivoVentaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_motivo_venta()
    {
        $motivoVenta = factory(MotivoVenta::class)->make()->toArray();

        $createdMotivoVenta = $this->motivoVentaRepo->create($motivoVenta);

        $createdMotivoVenta = $createdMotivoVenta->toArray();
        $this->assertArrayHasKey('id', $createdMotivoVenta);
        $this->assertNotNull($createdMotivoVenta['id'], 'Created MotivoVenta must have id specified');
        $this->assertNotNull(MotivoVenta::find($createdMotivoVenta['id']), 'MotivoVenta with given id must be in DB');
        $this->assertModelData($motivoVenta, $createdMotivoVenta);
    }

    /**
     * @test read
     */
    public function test_read_motivo_venta()
    {
        $motivoVenta = factory(MotivoVenta::class)->create();

        $dbMotivoVenta = $this->motivoVentaRepo->find($motivoVenta->id);

        $dbMotivoVenta = $dbMotivoVenta->toArray();
        $this->assertModelData($motivoVenta->toArray(), $dbMotivoVenta);
    }

    /**
     * @test update
     */
    public function test_update_motivo_venta()
    {
        $motivoVenta = factory(MotivoVenta::class)->create();
        $fakeMotivoVenta = factory(MotivoVenta::class)->make()->toArray();

        $updatedMotivoVenta = $this->motivoVentaRepo->update($fakeMotivoVenta, $motivoVenta->id);

        $this->assertModelData($fakeMotivoVenta, $updatedMotivoVenta->toArray());
        $dbMotivoVenta = $this->motivoVentaRepo->find($motivoVenta->id);
        $this->assertModelData($fakeMotivoVenta, $dbMotivoVenta->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_motivo_venta()
    {
        $motivoVenta = factory(MotivoVenta::class)->create();

        $resp = $this->motivoVentaRepo->delete($motivoVenta->id);

        $this->assertTrue($resp);
        $this->assertNull(MotivoVenta::find($motivoVenta->id), 'MotivoVenta should not exist in DB');
    }
}
