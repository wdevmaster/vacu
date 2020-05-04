<?php namespace Tests\Repositories;

use Modules\Finca\Entities\Finca;
use Modules\Finca\Repositories\FincaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class FincaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var FincaRepository
     */
    protected $fincaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->fincaRepo = \App::make(FincaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_finca()
    {
        $finca = factory(Finca::class)->make()->toArray();

        $createdFinca = $this->fincaRepo->create($finca);

        $createdFinca = $createdFinca->toArray();
        $this->assertArrayHasKey('id', $createdFinca);
        $this->assertNotNull($createdFinca['id'], 'Created Finca must have id specified');
        $this->assertNotNull(Finca::find($createdFinca['id']), 'Finca with given id must be in DB');
        $this->assertModelData($finca, $createdFinca);
    }

    /**
     * @test read
     */
    public function test_read_finca()
    {
        $finca = factory(Finca::class)->create();

        $dbFinca = $this->fincaRepo->find($finca->id);

        $dbFinca = $dbFinca->toArray();
        $this->assertModelData($finca->toArray(), $dbFinca);
    }

    /**
     * @test update
     */
    public function test_update_finca()
    {
        $finca = factory(Finca::class)->create();
        $fakeFinca = factory(Finca::class)->make()->toArray();

        $updatedFinca = $this->fincaRepo->update($fakeFinca, $finca->id);

        $this->assertModelData($fakeFinca, $updatedFinca->toArray());
        $dbFinca = $this->fincaRepo->find($finca->id);
        $this->assertModelData($fakeFinca, $dbFinca->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_finca()
    {
        $finca = factory(Finca::class)->create();

        $resp = $this->fincaRepo->delete($finca->id);

        $this->assertTrue($resp);
        $this->assertNull(Finca::find($finca->id), 'Finca should not exist in DB');
    }
}
