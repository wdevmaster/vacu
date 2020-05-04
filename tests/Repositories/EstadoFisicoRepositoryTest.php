<?php namespace Tests\Repositories;

use Modules\EstadoFisico\Entities\EstadoFisico;
use Modules\EstadoFisico\Repositories\EstadoFisicoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class EstadoFisicoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var EstadoFisicoRepository
     */
    protected $estadoFisicoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->estadoFisicoRepo = \App::make(EstadoFisicoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_estado_fisico()
    {
        $estadoFisico = factory(EstadoFisico::class)->make()->toArray();

        $createdEstadoFisico = $this->estadoFisicoRepo->create($estadoFisico);

        $createdEstadoFisico = $createdEstadoFisico->toArray();
        $this->assertArrayHasKey('id', $createdEstadoFisico);
        $this->assertNotNull($createdEstadoFisico['id'], 'Created EstadoFisico must have id specified');
        $this->assertNotNull(EstadoFisico::find($createdEstadoFisico['id']), 'EstadoFisico with given id must be in DB');
        $this->assertModelData($estadoFisico, $createdEstadoFisico);
    }

    /**
     * @test read
     */
    public function test_read_estado_fisico()
    {
        $estadoFisico = factory(EstadoFisico::class)->create();

        $dbEstadoFisico = $this->estadoFisicoRepo->find($estadoFisico->id);

        $dbEstadoFisico = $dbEstadoFisico->toArray();
        $this->assertModelData($estadoFisico->toArray(), $dbEstadoFisico);
    }

    /**
     * @test update
     */
    public function test_update_estado_fisico()
    {
        $estadoFisico = factory(EstadoFisico::class)->create();
        $fakeEstadoFisico = factory(EstadoFisico::class)->make()->toArray();

        $updatedEstadoFisico = $this->estadoFisicoRepo->update($fakeEstadoFisico, $estadoFisico->id);

        $this->assertModelData($fakeEstadoFisico, $updatedEstadoFisico->toArray());
        $dbEstadoFisico = $this->estadoFisicoRepo->find($estadoFisico->id);
        $this->assertModelData($fakeEstadoFisico, $dbEstadoFisico->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_estado_fisico()
    {
        $estadoFisico = factory(EstadoFisico::class)->create();

        $resp = $this->estadoFisicoRepo->delete($estadoFisico->id);

        $this->assertTrue($resp);
        $this->assertNull(EstadoFisico::find($estadoFisico->id), 'EstadoFisico should not exist in DB');
    }
}
