<?php namespace Tests\Repositories;

use Modules\Lactancia\Entities\Lactancia;
use Modules\Lactancia\Repositories\LactanciaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class LactanciaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var LactanciaRepository
     */
    protected $lactanciaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->lactanciaRepo = \App::make(LactanciaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_lactancia()
    {
        $lactancia = factory(Lactancia::class)->make()->toArray();

        $createdLactancia = $this->lactanciaRepo->create($lactancia);

        $createdLactancia = $createdLactancia->toArray();
        $this->assertArrayHasKey('id', $createdLactancia);
        $this->assertNotNull($createdLactancia['id'], 'Created Lactancia must have id specified');
        $this->assertNotNull(Lactancia::find($createdLactancia['id']), 'Lactancia with given id must be in DB');
        $this->assertModelData($lactancia, $createdLactancia);
    }

    /**
     * @test read
     */
    public function test_read_lactancia()
    {
        $lactancia = factory(Lactancia::class)->create();

        $dbLactancia = $this->lactanciaRepo->find($lactancia->id);

        $dbLactancia = $dbLactancia->toArray();
        $this->assertModelData($lactancia->toArray(), $dbLactancia);
    }

    /**
     * @test update
     */
    public function test_update_lactancia()
    {
        $lactancia = factory(Lactancia::class)->create();
        $fakeLactancia = factory(Lactancia::class)->make()->toArray();

        $updatedLactancia = $this->lactanciaRepo->update($fakeLactancia, $lactancia->id);

        $this->assertModelData($fakeLactancia, $updatedLactancia->toArray());
        $dbLactancia = $this->lactanciaRepo->find($lactancia->id);
        $this->assertModelData($fakeLactancia, $dbLactancia->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_lactancia()
    {
        $lactancia = factory(Lactancia::class)->create();

        $resp = $this->lactanciaRepo->delete($lactancia->id);

        $this->assertTrue($resp);
        $this->assertNull(Lactancia::find($lactancia->id), 'Lactancia should not exist in DB');
    }
}
