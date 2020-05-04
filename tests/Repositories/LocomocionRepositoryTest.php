<?php namespace Tests\Repositories;

use Modules\Locomocion\Entities\Locomocion;
use Modules\Locomocion\Repositories\LocomocionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class LocomocionRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var LocomocionRepository
     */
    protected $locomocionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->locomocionRepo = \App::make(LocomocionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_locomocion()
    {
        $locomocion = factory(Locomocion::class)->make()->toArray();

        $createdLocomocion = $this->locomocionRepo->create($locomocion);

        $createdLocomocion = $createdLocomocion->toArray();
        $this->assertArrayHasKey('id', $createdLocomocion);
        $this->assertNotNull($createdLocomocion['id'], 'Created Locomocion must have id specified');
        $this->assertNotNull(Locomocion::find($createdLocomocion['id']), 'Locomocion with given id must be in DB');
        $this->assertModelData($locomocion, $createdLocomocion);
    }

    /**
     * @test read
     */
    public function test_read_locomocion()
    {
        $locomocion = factory(Locomocion::class)->create();

        $dbLocomocion = $this->locomocionRepo->find($locomocion->id);

        $dbLocomocion = $dbLocomocion->toArray();
        $this->assertModelData($locomocion->toArray(), $dbLocomocion);
    }

    /**
     * @test update
     */
    public function test_update_locomocion()
    {
        $locomocion = factory(Locomocion::class)->create();
        $fakeLocomocion = factory(Locomocion::class)->make()->toArray();

        $updatedLocomocion = $this->locomocionRepo->update($fakeLocomocion, $locomocion->id);

        $this->assertModelData($fakeLocomocion, $updatedLocomocion->toArray());
        $dbLocomocion = $this->locomocionRepo->find($locomocion->id);
        $this->assertModelData($fakeLocomocion, $dbLocomocion->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_locomocion()
    {
        $locomocion = factory(Locomocion::class)->create();

        $resp = $this->locomocionRepo->delete($locomocion->id);

        $this->assertTrue($resp);
        $this->assertNull(Locomocion::find($locomocion->id), 'Locomocion should not exist in DB');
    }
}
