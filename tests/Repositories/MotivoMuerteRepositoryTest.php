<?php namespace Tests\Repositories;

use Modules\Muerte\Entities\MotivoMuerte;
use Modules\Muerte\Repositories\MotivoMuerteRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MotivoMuerteRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MotivoMuerteRepository
     */
    protected $motivoMuerteRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->motivoMuerteRepo = \App::make(MotivoMuerteRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_motivo_muerte()
    {
        $motivoMuerte = factory(MotivoMuerte::class)->make()->toArray();

        $createdMotivoMuerte = $this->motivoMuerteRepo->create($motivoMuerte);

        $createdMotivoMuerte = $createdMotivoMuerte->toArray();
        $this->assertArrayHasKey('id', $createdMotivoMuerte);
        $this->assertNotNull($createdMotivoMuerte['id'], 'Created MotivoMuerte must have id specified');
        $this->assertNotNull(MotivoMuerte::find($createdMotivoMuerte['id']), 'MotivoMuerte with given id must be in DB');
        $this->assertModelData($motivoMuerte, $createdMotivoMuerte);
    }

    /**
     * @test read
     */
    public function test_read_motivo_muerte()
    {
        $motivoMuerte = factory(MotivoMuerte::class)->create();

        $dbMotivoMuerte = $this->motivoMuerteRepo->find($motivoMuerte->id);

        $dbMotivoMuerte = $dbMotivoMuerte->toArray();
        $this->assertModelData($motivoMuerte->toArray(), $dbMotivoMuerte);
    }

    /**
     * @test update
     */
    public function test_update_motivo_muerte()
    {
        $motivoMuerte = factory(MotivoMuerte::class)->create();
        $fakeMotivoMuerte = factory(MotivoMuerte::class)->make()->toArray();

        $updatedMotivoMuerte = $this->motivoMuerteRepo->update($fakeMotivoMuerte, $motivoMuerte->id);

        $this->assertModelData($fakeMotivoMuerte, $updatedMotivoMuerte->toArray());
        $dbMotivoMuerte = $this->motivoMuerteRepo->find($motivoMuerte->id);
        $this->assertModelData($fakeMotivoMuerte, $dbMotivoMuerte->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_motivo_muerte()
    {
        $motivoMuerte = factory(MotivoMuerte::class)->create();

        $resp = $this->motivoMuerteRepo->delete($motivoMuerte->id);

        $this->assertTrue($resp);
        $this->assertNull(MotivoMuerte::find($motivoMuerte->id), 'MotivoMuerte should not exist in DB');
    }
}
