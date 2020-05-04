<?php namespace Tests\Repositories;

use Modules\TipoServicio\Entities\TipoServicio;
use Modules\TipoServicio\Repositories\TipoServicioRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TipoServicioRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TipoServicioRepository
     */
    protected $tipoServicioRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->tipoServicioRepo = \App::make(TipoServicioRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_tipo_servicio()
    {
        $tipoServicio = factory(TipoServicio::class)->make()->toArray();

        $createdTipoServicio = $this->tipoServicioRepo->create($tipoServicio);

        $createdTipoServicio = $createdTipoServicio->toArray();
        $this->assertArrayHasKey('id', $createdTipoServicio);
        $this->assertNotNull($createdTipoServicio['id'], 'Created TipoServicio must have id specified');
        $this->assertNotNull(TipoServicio::find($createdTipoServicio['id']), 'TipoServicio with given id must be in DB');
        $this->assertModelData($tipoServicio, $createdTipoServicio);
    }

    /**
     * @test read
     */
    public function test_read_tipo_servicio()
    {
        $tipoServicio = factory(TipoServicio::class)->create();

        $dbTipoServicio = $this->tipoServicioRepo->find($tipoServicio->id);

        $dbTipoServicio = $dbTipoServicio->toArray();
        $this->assertModelData($tipoServicio->toArray(), $dbTipoServicio);
    }

    /**
     * @test update
     */
    public function test_update_tipo_servicio()
    {
        $tipoServicio = factory(TipoServicio::class)->create();
        $fakeTipoServicio = factory(TipoServicio::class)->make()->toArray();

        $updatedTipoServicio = $this->tipoServicioRepo->update($fakeTipoServicio, $tipoServicio->id);

        $this->assertModelData($fakeTipoServicio, $updatedTipoServicio->toArray());
        $dbTipoServicio = $this->tipoServicioRepo->find($tipoServicio->id);
        $this->assertModelData($fakeTipoServicio, $dbTipoServicio->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_tipo_servicio()
    {
        $tipoServicio = factory(TipoServicio::class)->create();

        $resp = $this->tipoServicioRepo->delete($tipoServicio->id);

        $this->assertTrue($resp);
        $this->assertNull(TipoServicio::find($tipoServicio->id), 'TipoServicio should not exist in DB');
    }
}
