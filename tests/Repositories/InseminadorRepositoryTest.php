<?php namespace Tests\Repositories;

use Modules\Inseminador\Entities\Inseminador;
use Modules\Inseminador\Repositories\InseminadorRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class InseminadorRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var InseminadorRepository
     */
    protected $inseminadorRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->inseminadorRepo = \App::make(InseminadorRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_inseminador()
    {
        $inseminador = factory(Inseminador::class)->make()->toArray();

        $createdInseminador = $this->inseminadorRepo->create($inseminador);

        $createdInseminador = $createdInseminador->toArray();
        $this->assertArrayHasKey('id', $createdInseminador);
        $this->assertNotNull($createdInseminador['id'], 'Created Inseminador must have id specified');
        $this->assertNotNull(Inseminador::find($createdInseminador['id']), 'Inseminador with given id must be in DB');
        $this->assertModelData($inseminador, $createdInseminador);
    }

    /**
     * @test read
     */
    public function test_read_inseminador()
    {
        $inseminador = factory(Inseminador::class)->create();

        $dbInseminador = $this->inseminadorRepo->find($inseminador->id);

        $dbInseminador = $dbInseminador->toArray();
        $this->assertModelData($inseminador->toArray(), $dbInseminador);
    }

    /**
     * @test update
     */
    public function test_update_inseminador()
    {
        $inseminador = factory(Inseminador::class)->create();
        $fakeInseminador = factory(Inseminador::class)->make()->toArray();

        $updatedInseminador = $this->inseminadorRepo->update($fakeInseminador, $inseminador->id);

        $this->assertModelData($fakeInseminador, $updatedInseminador->toArray());
        $dbInseminador = $this->inseminadorRepo->find($inseminador->id);
        $this->assertModelData($fakeInseminador, $dbInseminador->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_inseminador()
    {
        $inseminador = factory(Inseminador::class)->create();

        $resp = $this->inseminadorRepo->delete($inseminador->id);

        $this->assertTrue($resp);
        $this->assertNull(Inseminador::find($inseminador->id), 'Inseminador should not exist in DB');
    }
}
