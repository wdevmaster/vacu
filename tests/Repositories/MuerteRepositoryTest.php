<?php namespace Tests\Repositories;

use Modules\Muerte\Entities\Muerte;
use Modules\Muerte\Repositories\MuerteRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MuerteRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MuerteRepository
     */
    protected $muerteRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->muerteRepo = \App::make(MuerteRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_muerte()
    {
        $muerte = factory(Muerte::class)->make()->toArray();

        $createdMuerte = $this->muerteRepo->create($muerte);

        $createdMuerte = $createdMuerte->toArray();
        $this->assertArrayHasKey('id', $createdMuerte);
        $this->assertNotNull($createdMuerte['id'], 'Created Muerte must have id specified');
        $this->assertNotNull(Muerte::find($createdMuerte['id']), 'Muerte with given id must be in DB');
        $this->assertModelData($muerte, $createdMuerte);
    }

    /**
     * @test read
     */
    public function test_read_muerte()
    {
        $muerte = factory(Muerte::class)->create();

        $dbMuerte = $this->muerteRepo->find($muerte->id);

        $dbMuerte = $dbMuerte->toArray();
        $this->assertModelData($muerte->toArray(), $dbMuerte);
    }

    /**
     * @test update
     */
    public function test_update_muerte()
    {
        $muerte = factory(Muerte::class)->create();
        $fakeMuerte = factory(Muerte::class)->make()->toArray();

        $updatedMuerte = $this->muerteRepo->update($fakeMuerte, $muerte->id);

        $this->assertModelData($fakeMuerte, $updatedMuerte->toArray());
        $dbMuerte = $this->muerteRepo->find($muerte->id);
        $this->assertModelData($fakeMuerte, $dbMuerte->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_muerte()
    {
        $muerte = factory(Muerte::class)->create();

        $resp = $this->muerteRepo->delete($muerte->id);

        $this->assertTrue($resp);
        $this->assertNull(Muerte::find($muerte->id), 'Muerte should not exist in DB');
    }
}
