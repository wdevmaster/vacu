<?php namespace Tests\Repositories;

use Modules\Animal\Entities\Tratamiento;
use Modules\Animal\Repositories\TratamientoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TratamientoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TratamientoRepository
     */
    protected $tratamientoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->tratamientoRepo = \App::make(TratamientoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_tratamiento()
    {
        $tratamiento = factory(Tratamiento::class)->make()->toArray();

        $createdTratamiento = $this->tratamientoRepo->create($tratamiento);

        $createdTratamiento = $createdTratamiento->toArray();
        $this->assertArrayHasKey('id', $createdTratamiento);
        $this->assertNotNull($createdTratamiento['id'], 'Created Tratamiento must have id specified');
        $this->assertNotNull(Tratamiento::find($createdTratamiento['id']), 'Tratamiento with given id must be in DB');
        $this->assertModelData($tratamiento, $createdTratamiento);
    }

    /**
     * @test read
     */
    public function test_read_tratamiento()
    {
        $tratamiento = factory(Tratamiento::class)->create();

        $dbTratamiento = $this->tratamientoRepo->find($tratamiento->id);

        $dbTratamiento = $dbTratamiento->toArray();
        $this->assertModelData($tratamiento->toArray(), $dbTratamiento);
    }

    /**
     * @test update
     */
    public function test_update_tratamiento()
    {
        $tratamiento = factory(Tratamiento::class)->create();
        $fakeTratamiento = factory(Tratamiento::class)->make()->toArray();

        $updatedTratamiento = $this->tratamientoRepo->update($fakeTratamiento, $tratamiento->id);

        $this->assertModelData($fakeTratamiento, $updatedTratamiento->toArray());
        $dbTratamiento = $this->tratamientoRepo->find($tratamiento->id);
        $this->assertModelData($fakeTratamiento, $dbTratamiento->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_tratamiento()
    {
        $tratamiento = factory(Tratamiento::class)->create();

        $resp = $this->tratamientoRepo->delete($tratamiento->id);

        $this->assertTrue($resp);
        $this->assertNull(Tratamiento::find($tratamiento->id), 'Tratamiento should not exist in DB');
    }
}
