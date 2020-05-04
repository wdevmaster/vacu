<?php namespace Tests\Repositories;

use Modules\RegistroEnfermedad\Entities\RegistroEnfermedad;
use Modules\RegistroEnfermedad\Repositories\RegistroEnfermedadRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class RegistroEnfermedadRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var RegistroEnfermedadRepository
     */
    protected $registroEnfermedadRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->registroEnfermedadRepo = \App::make(RegistroEnfermedadRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_registro_enfermedad()
    {
        $registroEnfermedad = factory(RegistroEnfermedad::class)->make()->toArray();

        $createdRegistroEnfermedad = $this->registroEnfermedadRepo->create($registroEnfermedad);

        $createdRegistroEnfermedad = $createdRegistroEnfermedad->toArray();
        $this->assertArrayHasKey('id', $createdRegistroEnfermedad);
        $this->assertNotNull($createdRegistroEnfermedad['id'], 'Created RegistroEnfermedad must have id specified');
        $this->assertNotNull(RegistroEnfermedad::find($createdRegistroEnfermedad['id']), 'RegistroEnfermedad with given id must be in DB');
        $this->assertModelData($registroEnfermedad, $createdRegistroEnfermedad);
    }

    /**
     * @test read
     */
    public function test_read_registro_enfermedad()
    {
        $registroEnfermedad = factory(RegistroEnfermedad::class)->create();

        $dbRegistroEnfermedad = $this->registroEnfermedadRepo->find($registroEnfermedad->id);

        $dbRegistroEnfermedad = $dbRegistroEnfermedad->toArray();
        $this->assertModelData($registroEnfermedad->toArray(), $dbRegistroEnfermedad);
    }

    /**
     * @test update
     */
    public function test_update_registro_enfermedad()
    {
        $registroEnfermedad = factory(RegistroEnfermedad::class)->create();
        $fakeRegistroEnfermedad = factory(RegistroEnfermedad::class)->make()->toArray();

        $updatedRegistroEnfermedad = $this->registroEnfermedadRepo->update($fakeRegistroEnfermedad, $registroEnfermedad->id);

        $this->assertModelData($fakeRegistroEnfermedad, $updatedRegistroEnfermedad->toArray());
        $dbRegistroEnfermedad = $this->registroEnfermedadRepo->find($registroEnfermedad->id);
        $this->assertModelData($fakeRegistroEnfermedad, $dbRegistroEnfermedad->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_registro_enfermedad()
    {
        $registroEnfermedad = factory(RegistroEnfermedad::class)->create();

        $resp = $this->registroEnfermedadRepo->delete($registroEnfermedad->id);

        $this->assertTrue($resp);
        $this->assertNull(RegistroEnfermedad::find($registroEnfermedad->id), 'RegistroEnfermedad should not exist in DB');
    }
}
