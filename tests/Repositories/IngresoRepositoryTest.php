<?php namespace Tests\Repositories;

use Modules\Ingreso\Entities\Ingreso;
use Modules\Ingreso\Repositories\IngresoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class IngresoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var IngresoRepository
     */
    protected $ingresoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->ingresoRepo = \App::make(IngresoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_ingreso()
    {
        $ingreso = factory(Ingreso::class)->make()->toArray();

        $createdIngreso = $this->ingresoRepo->create($ingreso);

        $createdIngreso = $createdIngreso->toArray();
        $this->assertArrayHasKey('id', $createdIngreso);
        $this->assertNotNull($createdIngreso['id'], 'Created Ingreso must have id specified');
        $this->assertNotNull(Ingreso::find($createdIngreso['id']), 'Ingreso with given id must be in DB');
        $this->assertModelData($ingreso, $createdIngreso);
    }

    /**
     * @test read
     */
    public function test_read_ingreso()
    {
        $ingreso = factory(Ingreso::class)->create();

        $dbIngreso = $this->ingresoRepo->find($ingreso->id);

        $dbIngreso = $dbIngreso->toArray();
        $this->assertModelData($ingreso->toArray(), $dbIngreso);
    }

    /**
     * @test update
     */
    public function test_update_ingreso()
    {
        $ingreso = factory(Ingreso::class)->create();
        $fakeIngreso = factory(Ingreso::class)->make()->toArray();

        $updatedIngreso = $this->ingresoRepo->update($fakeIngreso, $ingreso->id);

        $this->assertModelData($fakeIngreso, $updatedIngreso->toArray());
        $dbIngreso = $this->ingresoRepo->find($ingreso->id);
        $this->assertModelData($fakeIngreso, $dbIngreso->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_ingreso()
    {
        $ingreso = factory(Ingreso::class)->create();

        $resp = $this->ingresoRepo->delete($ingreso->id);

        $this->assertTrue($resp);
        $this->assertNull(Ingreso::find($ingreso->id), 'Ingreso should not exist in DB');
    }
}
