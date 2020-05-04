<?php namespace Tests\Repositories;

use Modules\Negocio\Entities\Negocio;
use Modules\Negocio\Repositories\NegocioRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class NegocioRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var NegocioRepository
     */
    protected $negocioRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->negocioRepo = \App::make(NegocioRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_negocio()
    {
        $negocio = factory(Negocio::class)->make()->toArray();

        $createdNegocio = $this->negocioRepo->create($negocio);

        $createdNegocio = $createdNegocio->toArray();
        $this->assertArrayHasKey('id', $createdNegocio);
        $this->assertNotNull($createdNegocio['id'], 'Created Negocio must have id specified');
        $this->assertNotNull(Negocio::find($createdNegocio['id']), 'Negocio with given id must be in DB');
        $this->assertModelData($negocio, $createdNegocio);
    }

    /**
     * @test read
     */
    public function test_read_negocio()
    {
        $negocio = factory(Negocio::class)->create();

        $dbNegocio = $this->negocioRepo->find($negocio->id);

        $dbNegocio = $dbNegocio->toArray();
        $this->assertModelData($negocio->toArray(), $dbNegocio);
    }

    /**
     * @test update
     */
    public function test_update_negocio()
    {
        $negocio = factory(Negocio::class)->create();
        $fakeNegocio = factory(Negocio::class)->make()->toArray();

        $updatedNegocio = $this->negocioRepo->update($fakeNegocio, $negocio->id);

        $this->assertModelData($fakeNegocio, $updatedNegocio->toArray());
        $dbNegocio = $this->negocioRepo->find($negocio->id);
        $this->assertModelData($fakeNegocio, $dbNegocio->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_negocio()
    {
        $negocio = factory(Negocio::class)->create();

        $resp = $this->negocioRepo->delete($negocio->id);

        $this->assertTrue($resp);
        $this->assertNull(Negocio::find($negocio->id), 'Negocio should not exist in DB');
    }
}
