<?php namespace Tests\Repositories;

use Modules\Animal\Entities\Palpacion;
use Modules\Animal\Repositories\PalpacionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PalpacionRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var PalpacionRepository
     */
    protected $palpacionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->palpacionRepo = \App::make(PalpacionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_palpacion()
    {
        $palpacion = factory(Palpacion::class)->make()->toArray();

        $createdPalpacion = $this->palpacionRepo->create($palpacion);

        $createdPalpacion = $createdPalpacion->toArray();
        $this->assertArrayHasKey('id', $createdPalpacion);
        $this->assertNotNull($createdPalpacion['id'], 'Created Palpacion must have id specified');
        $this->assertNotNull(Palpacion::find($createdPalpacion['id']), 'Palpacion with given id must be in DB');
        $this->assertModelData($palpacion, $createdPalpacion);
    }

    /**
     * @test read
     */
    public function test_read_palpacion()
    {
        $palpacion = factory(Palpacion::class)->create();

        $dbPalpacion = $this->palpacionRepo->find($palpacion->id);

        $dbPalpacion = $dbPalpacion->toArray();
        $this->assertModelData($palpacion->toArray(), $dbPalpacion);
    }

    /**
     * @test update
     */
    public function test_update_palpacion()
    {
        $palpacion = factory(Palpacion::class)->create();
        $fakePalpacion = factory(Palpacion::class)->make()->toArray();

        $updatedPalpacion = $this->palpacionRepo->update($fakePalpacion, $palpacion->id);

        $this->assertModelData($fakePalpacion, $updatedPalpacion->toArray());
        $dbPalpacion = $this->palpacionRepo->find($palpacion->id);
        $this->assertModelData($fakePalpacion, $dbPalpacion->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_palpacion()
    {
        $palpacion = factory(Palpacion::class)->create();

        $resp = $this->palpacionRepo->delete($palpacion->id);

        $this->assertTrue($resp);
        $this->assertNull(Palpacion::find($palpacion->id), 'Palpacion should not exist in DB');
    }
}
