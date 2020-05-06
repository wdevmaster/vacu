<?php namespace Tests\Repositories;

use Modules\Sincronizacion\Entities\Syncronizacion;
use Modules\Sincronizacion\Repositories\SyncronizacionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class SyncronizacionRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var SyncronizacionRepository
     */
    protected $syncronizacionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->syncronizacionRepo = \App::make(SyncronizacionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_syncronizacion()
    {
        $syncronizacion = factory(Syncronizacion::class)->make()->toArray();

        $createdSyncronizacion = $this->syncronizacionRepo->create($syncronizacion);

        $createdSyncronizacion = $createdSyncronizacion->toArray();
        $this->assertArrayHasKey('id', $createdSyncronizacion);
        $this->assertNotNull($createdSyncronizacion['id'], 'Created Syncronizacion must have id specified');
        $this->assertNotNull(Syncronizacion::find($createdSyncronizacion['id']), 'Syncronizacion with given id must be in DB');
        $this->assertModelData($syncronizacion, $createdSyncronizacion);
    }

    /**
     * @test read
     */
    public function test_read_syncronizacion()
    {
        $syncronizacion = factory(Syncronizacion::class)->create();

        $dbSyncronizacion = $this->syncronizacionRepo->find($syncronizacion->id);

        $dbSyncronizacion = $dbSyncronizacion->toArray();
        $this->assertModelData($syncronizacion->toArray(), $dbSyncronizacion);
    }

    /**
     * @test update
     */
    public function test_update_syncronizacion()
    {
        $syncronizacion = factory(Syncronizacion::class)->create();
        $fakeSyncronizacion = factory(Syncronizacion::class)->make()->toArray();

        $updatedSyncronizacion = $this->syncronizacionRepo->update($fakeSyncronizacion, $syncronizacion->id);

        $this->assertModelData($fakeSyncronizacion, $updatedSyncronizacion->toArray());
        $dbSyncronizacion = $this->syncronizacionRepo->find($syncronizacion->id);
        $this->assertModelData($fakeSyncronizacion, $dbSyncronizacion->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_syncronizacion()
    {
        $syncronizacion = factory(Syncronizacion::class)->create();

        $resp = $this->syncronizacionRepo->delete($syncronizacion->id);

        $this->assertTrue($resp);
        $this->assertNull(Syncronizacion::find($syncronizacion->id), 'Syncronizacion should not exist in DB');
    }
}
