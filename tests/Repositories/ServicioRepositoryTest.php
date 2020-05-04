<?php namespace Tests\Repositories;

use Modules\Servicio\Entities\Servicio;
use Modules\Servicio\Repositories\ServicioRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ServicioRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ServicioRepository
     */
    protected $servicioRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->servicioRepo = \App::make(ServicioRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_servicio()
    {
        $servicio = factory(Servicio::class)->make()->toArray();

        $createdServicio = $this->servicioRepo->create($servicio);

        $createdServicio = $createdServicio->toArray();
        $this->assertArrayHasKey('id', $createdServicio);
        $this->assertNotNull($createdServicio['id'], 'Created Servicio must have id specified');
        $this->assertNotNull(Servicio::find($createdServicio['id']), 'Servicio with given id must be in DB');
        $this->assertModelData($servicio, $createdServicio);
    }

    /**
     * @test read
     */
    public function test_read_servicio()
    {
        $servicio = factory(Servicio::class)->create();

        $dbServicio = $this->servicioRepo->find($servicio->id);

        $dbServicio = $dbServicio->toArray();
        $this->assertModelData($servicio->toArray(), $dbServicio);
    }

    /**
     * @test update
     */
    public function test_update_servicio()
    {
        $servicio = factory(Servicio::class)->create();
        $fakeServicio = factory(Servicio::class)->make()->toArray();

        $updatedServicio = $this->servicioRepo->update($fakeServicio, $servicio->id);

        $this->assertModelData($fakeServicio, $updatedServicio->toArray());
        $dbServicio = $this->servicioRepo->find($servicio->id);
        $this->assertModelData($fakeServicio, $dbServicio->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_servicio()
    {
        $servicio = factory(Servicio::class)->create();

        $resp = $this->servicioRepo->delete($servicio->id);

        $this->assertTrue($resp);
        $this->assertNull(Servicio::find($servicio->id), 'Servicio should not exist in DB');
    }
}
