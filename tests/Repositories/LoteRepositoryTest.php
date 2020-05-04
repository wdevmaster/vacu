<?php namespace Tests\Repositories;

use Modules\Lote\Entities\Lote;
use Modules\Lote\Repositories\LoteRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class LoteRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var LoteRepository
     */
    protected $loteRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->loteRepo = \App::make(LoteRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_lote()
    {
        $lote = factory(Lote::class)->make()->toArray();

        $createdLote = $this->loteRepo->create($lote);

        $createdLote = $createdLote->toArray();
        $this->assertArrayHasKey('id', $createdLote);
        $this->assertNotNull($createdLote['id'], 'Created Lote must have id specified');
        $this->assertNotNull(Lote::find($createdLote['id']), 'Lote with given id must be in DB');
        $this->assertModelData($lote, $createdLote);
    }

    /**
     * @test read
     */
    public function test_read_lote()
    {
        $lote = factory(Lote::class)->create();

        $dbLote = $this->loteRepo->find($lote->id);

        $dbLote = $dbLote->toArray();
        $this->assertModelData($lote->toArray(), $dbLote);
    }

    /**
     * @test update
     */
    public function test_update_lote()
    {
        $lote = factory(Lote::class)->create();
        $fakeLote = factory(Lote::class)->make()->toArray();

        $updatedLote = $this->loteRepo->update($fakeLote, $lote->id);

        $this->assertModelData($fakeLote, $updatedLote->toArray());
        $dbLote = $this->loteRepo->find($lote->id);
        $this->assertModelData($fakeLote, $dbLote->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_lote()
    {
        $lote = factory(Lote::class)->create();

        $resp = $this->loteRepo->delete($lote->id);

        $this->assertTrue($resp);
        $this->assertNull(Lote::find($lote->id), 'Lote should not exist in DB');
    }
}
