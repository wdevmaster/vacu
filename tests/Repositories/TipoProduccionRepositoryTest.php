<?php namespace Tests\Repositories;

use Modules\Animal\Entities\TipoProduccion;
use Modules\Animal\Repositories\TipoProduccionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TipoProduccionRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TipoProduccionRepository
     */
    protected $tipoProduccionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->tipoProduccionRepo = \App::make(TipoProduccionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_tipo_produccion()
    {
        $tipoProduccion = factory(TipoProduccion::class)->make()->toArray();

        $createdTipoProduccion = $this->tipoProduccionRepo->create($tipoProduccion);

        $createdTipoProduccion = $createdTipoProduccion->toArray();
        $this->assertArrayHasKey('id', $createdTipoProduccion);
        $this->assertNotNull($createdTipoProduccion['id'], 'Created TipoProduccion must have id specified');
        $this->assertNotNull(TipoProduccion::find($createdTipoProduccion['id']), 'TipoProduccion with given id must be in DB');
        $this->assertModelData($tipoProduccion, $createdTipoProduccion);
    }

    /**
     * @test read
     */
    public function test_read_tipo_produccion()
    {
        $tipoProduccion = factory(TipoProduccion::class)->create();

        $dbTipoProduccion = $this->tipoProduccionRepo->find($tipoProduccion->id);

        $dbTipoProduccion = $dbTipoProduccion->toArray();
        $this->assertModelData($tipoProduccion->toArray(), $dbTipoProduccion);
    }

    /**
     * @test update
     */
    public function test_update_tipo_produccion()
    {
        $tipoProduccion = factory(TipoProduccion::class)->create();
        $fakeTipoProduccion = factory(TipoProduccion::class)->make()->toArray();

        $updatedTipoProduccion = $this->tipoProduccionRepo->update($fakeTipoProduccion, $tipoProduccion->id);

        $this->assertModelData($fakeTipoProduccion, $updatedTipoProduccion->toArray());
        $dbTipoProduccion = $this->tipoProduccionRepo->find($tipoProduccion->id);
        $this->assertModelData($fakeTipoProduccion, $dbTipoProduccion->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_tipo_produccion()
    {
        $tipoProduccion = factory(TipoProduccion::class)->create();

        $resp = $this->tipoProduccionRepo->delete($tipoProduccion->id);

        $this->assertTrue($resp);
        $this->assertNull(TipoProduccion::find($tipoProduccion->id), 'TipoProduccion should not exist in DB');
    }
}
