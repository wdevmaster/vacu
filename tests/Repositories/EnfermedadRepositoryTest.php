<?php namespace Tests\Repositories;

use Modules\Enfermedad\Entities\Enfermedad;
use Modules\Enfermedad\Repositories\EnfermedadRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class EnfermedadRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var EnfermedadRepository
     */
    protected $enfermedadRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->enfermedadRepo = \App::make(EnfermedadRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_enfermedad()
    {
        $enfermedad = factory(Enfermedad::class)->make()->toArray();

        $createdEnfermedad = $this->enfermedadRepo->create($enfermedad);

        $createdEnfermedad = $createdEnfermedad->toArray();
        $this->assertArrayHasKey('id', $createdEnfermedad);
        $this->assertNotNull($createdEnfermedad['id'], 'Created Enfermedad must have id specified');
        $this->assertNotNull(Enfermedad::find($createdEnfermedad['id']), 'Enfermedad with given id must be in DB');
        $this->assertModelData($enfermedad, $createdEnfermedad);
    }

    /**
     * @test read
     */
    public function test_read_enfermedad()
    {
        $enfermedad = factory(Enfermedad::class)->create();

        $dbEnfermedad = $this->enfermedadRepo->find($enfermedad->id);

        $dbEnfermedad = $dbEnfermedad->toArray();
        $this->assertModelData($enfermedad->toArray(), $dbEnfermedad);
    }

    /**
     * @test update
     */
    public function test_update_enfermedad()
    {
        $enfermedad = factory(Enfermedad::class)->create();
        $fakeEnfermedad = factory(Enfermedad::class)->make()->toArray();

        $updatedEnfermedad = $this->enfermedadRepo->update($fakeEnfermedad, $enfermedad->id);

        $this->assertModelData($fakeEnfermedad, $updatedEnfermedad->toArray());
        $dbEnfermedad = $this->enfermedadRepo->find($enfermedad->id);
        $this->assertModelData($fakeEnfermedad, $dbEnfermedad->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_enfermedad()
    {
        $enfermedad = factory(Enfermedad::class)->create();

        $resp = $this->enfermedadRepo->delete($enfermedad->id);

        $this->assertTrue($resp);
        $this->assertNull(Enfermedad::find($enfermedad->id), 'Enfermedad should not exist in DB');
    }
}
