<?php namespace Tests\Repositories;

use Modules\Produccion\Entities\Produccion;
use Modules\Produccion\Repositories\ProduccionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ProduccionRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProduccionRepository
     */
    protected $produccionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->produccionRepo = \App::make(ProduccionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_produccion()
    {
        $produccion = factory(Produccion::class)->make()->toArray();

        $createdProduccion = $this->produccionRepo->create($produccion);

        $createdProduccion = $createdProduccion->toArray();
        $this->assertArrayHasKey('id', $createdProduccion);
        $this->assertNotNull($createdProduccion['id'], 'Created Produccion must have id specified');
        $this->assertNotNull(Produccion::find($createdProduccion['id']), 'Produccion with given id must be in DB');
        $this->assertModelData($produccion, $createdProduccion);
    }

    /**
     * @test read
     */
    public function test_read_produccion()
    {
        $produccion = factory(Produccion::class)->create();

        $dbProduccion = $this->produccionRepo->find($produccion->id);

        $dbProduccion = $dbProduccion->toArray();
        $this->assertModelData($produccion->toArray(), $dbProduccion);
    }

    /**
     * @test update
     */
    public function test_update_produccion()
    {
        $produccion = factory(Produccion::class)->create();
        $fakeProduccion = factory(Produccion::class)->make()->toArray();

        $updatedProduccion = $this->produccionRepo->update($fakeProduccion, $produccion->id);

        $this->assertModelData($fakeProduccion, $updatedProduccion->toArray());
        $dbProduccion = $this->produccionRepo->find($produccion->id);
        $this->assertModelData($fakeProduccion, $dbProduccion->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_produccion()
    {
        $produccion = factory(Produccion::class)->create();

        $resp = $this->produccionRepo->delete($produccion->id);

        $this->assertTrue($resp);
        $this->assertNull(Produccion::find($produccion->id), 'Produccion should not exist in DB');
    }
}
